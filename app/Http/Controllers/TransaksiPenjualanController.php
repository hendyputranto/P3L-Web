<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransaksiPenjualan;
use App\Detil_TransaksiSparepart;
use App\Detil_TransaksiService;
use App\SparepartCabang;
use App\Pegawai_OnDuty;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Transformers\TransaksiPenjualanTransformer;
use Illuminate\Support\Facades\DB;

class TransaksiPenjualanController extends RestController
{
    protected $transformer = TransaksiPenjualanTransformer::class;
    
    public function show()
    {
        $transaksi = TransaksiPenjualan::all();
        $response = $this->generateCollection($transaksi);
        return $this->sendResponse($response);
    }
    public function showByStatusTransaksi($status)
    {
        if($status==0)
        {
            $transaksi = TransaksiPenjualan::where('status_transaksi','Belum Lunas')->get();
        }
        else if($status==1)
        {
            $transaksi = TransaksiPenjualan::where('status_transaksi','Sudah Lunas')->get();
        }
        $response = $this->generateCollection($transaksi);
        return $this->sendResponse($response);
    }
    public function showByPlatKonsumen($id)
    {
        //cari konsumen
        //penjualannya aku cari
        //terus aku bikin array untuk nampung id transaksi yang detil jasanya sesuai dengan motornya tadi
        //penjualannya terus aku pecah 1 -1 
        //penjualannya tipenya apa? kalo SS / SV , dia bakal nyari detil jasa yang id transaksinya sama kayak yg td yg uda di for each
        //detil jasa nyambung ke motor konsumen, nah itu di cek sama apa ndak.
        //kalo sama nanti pake array push
        //kalo sesuai, id transaksi nanti dimasukin.
        //kalo uda keluar dari for each, nanti bakal cari transaksi penjualan yang sesuai dengan tadi.

        $transaksi = TransaksiPenjualan::where('id_transaksi_fk',$id)->get();
        $response = $this->generateCollection($transaksi);
        return $this->sendResponse($response,201);
    }

    
    //Buatan sintaa
    public function update_status_transaksi_sinta($id)
    {
        $status_transaksi = "Sudah Lunas";
        try {
            $transaksi = TransaksiPenjualan::find($id);
            $transaksi->status_transaksi = $status_transaksi;
            $transaksi->save();
            $response = $this->generateItem($transaksi);
            return $this->sendResponse($response, 201);
        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }
    public function update_sinta(Request $request, $id)
    {
        try {
            $transaksiPenjualan = TransaksiPenjualan::find($id);
            if(!is_null($request->diskon))
            {
                $transaksiPenjualan->diskon = $request->diskon;
            }
            if(!is_null($request->total_transaksi))
            {
                $transaksiPenjualan->total_transaksi = $request->total_transaksi;
            }
            
            $detilServices = Detil_TransaksiService::where('id_transaksi_fk',$id)->get();
            foreach($detilServices as $detilService)
            {  
                $delDetilService = $detilService->delete();
            }
            $detilSpareparts = Detil_TransaksiSparepart::where('id_transaksi_fk',$id)->get();
            foreach($detilSpareparts as $detilSparepart)
            {  
                $dataSparepart = SparepartCabang::where('id_sparepartCabang',$detilSparepart->id_sparepartCabang_fk)->first();
                $dataSparepart->stokSisa_sparepart += $detilSparepart->jumlahBeli_sparepart;
                $dataSparepart->save();
                $delDetilSparepart = $detilSparepart->delete();
            }
            if($request->has('detil_sparepart'))
            {
                $detil = $request->detil_sparepart;
                $transaksiPenjualan = DB::transaction(function()use($transaksiPenjualan,$detil){
                $transaksiPenjualan->detil_transaksi_sparepart()->createMany($detil);
                return $transaksiPenjualan;
                });
            }
            if($request->has('detil_service'))
            {
                $detil = $request->detil_service;
                $transaksiPenjualan = DB::transaction(function()use($transaksiPenjualan,$detil){
                $transaksiPenjualan->detil_transaksi_service()->createMany($detil);
                return $transaksiPenjualan;
                });
            }
            $transaksiPenjualan->save();
            $response = $this->generateItem($transaksiPenjualan);
            return $this->sendResponse($response, 201);
        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }
    
    public function createTransaksiPenjualan_sinta(Request $request)
    {
        try{
            date_default_timezone_set('Asia/Jakarta');
            $transaksiPenjualan = new TransaksiPenjualan;

           
            $id = array();
            
            // $id = DB::select('select kode_transaksi from transaksi_penjualans order by substring(kode_transaksi, 11) + 0 desc limit 1');
            // $id = TransaksiPenjualan::orderBy('id_transaksi',DESC)->where('')
            $id = TransaksiPenjualan::orderBy('id_transaksi','DESC')->where('kode_transaksi','like',$request->tipe_transaksi.'%')->first();
            // return $id;
            if(!$id)
                $no = 1;
            else {
                $no_str = explode('-',$id->kode_transaksi);
                $no = ++$no_str[2];
                // $no_str = substr($id[0]->kode_transaksi, 10);
                // $no = ++$no_str;
            }

            $transaksiPenjualan->tgl_transaksi = date("Y-m-d").' '.date('H:i:s');
            $transaksiPenjualan->diskon = 0;
            $transaksiPenjualan->status_transaksi = "Belum Lunas";

            $transaksiPenjualan->kode_transaksi=$request->tipe_transaksi.'-'.date("d").date("m").date("y").'-'.$no;
            $transaksiPenjualan->id_cabang_fk=$request->id_cabang_fk;
            $transaksiPenjualan->total_transaksi = $request->total_transaksi;
            
            $transaksiPenjualan->save();
            if($request->has('detil_sparepart'))
            {
                $detil = $request->detil_sparepart;
                $transaksiPenjualan = DB::transaction(function()use($transaksiPenjualan,$detil){
                $transaksiPenjualan->detil_transaksi_sparepart()->createMany($detil);
                return $transaksiPenjualan;
                    //input data dalam bentuk array 2d, meskipun datanya cuma 1. 
                });
            }
            if($request->has('detil_service'))
            {
                $detil = $request->detil_service;
                $transaksiPenjualan = DB::transaction(function()use($transaksiPenjualan,$detil){
                $transaksiPenjualan->detil_transaksi_service()->createMany($detil);
                return $transaksiPenjualan;
                    //input data dalam bentuk array 2d, meskipun datanya cuma 1. 
                });
            }

            if($request->has('id_cs'))
            {
                $pegawai_on_duty[0]['id_pegawai_fk'] = $request->id_cs;
                if($request->id_montir !== null)
                {
                    $pegawai_on_duty[1]['id_pegawai_fk'] = $request->id_montir;
                }
                    
                $transaksiPenjualan = DB::transaction(function()use($transaksiPenjualan,$pegawai_on_duty){
                    $transaksiPenjualan->pegawai_onduty()->createMany($pegawai_on_duty);
                    return $transaksiPenjualan;
                    //input data dalam bentuk array 2d, meskipun datanya cuma 1. 
                });
            }
            
            $response = $this->generateItem($transaksiPenjualan);

            return $this->sendResponse($response, 201);

        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
    }
    
    public function deleteTransaksiPenjualan($id)
    {
        try {
            $detilServices = Detil_TransaksiService::where('id_transaksi_fk',$id)->get();
            foreach($detilServices as $detilService)
            {  
                $delDetilService = $detilService->delete();
            }
            $detilSpareparts = Detil_TransaksiSparepart::where('id_transaksi_fk',$id)->get();
            foreach($detilSpareparts as $detilSparepart)
            {  
                $dataSparepart = SparepartCabang::where('id_sparepartCabang',$detilSparepart->id_sparepartCabang_fk)->first();
                $dataSparepart->stokSisa_sparepart += $detilSparepart->jumlahBeli_sparepart;
                $dataSparepart->save();
                $delDetilSparepart = $detilSparepart->delete();
            }

            $pegawaiOnDuties = Pegawai_OnDuty::where('id_transaksi_fk',$id)->get();
            foreach($pegawaiOnDuties as $pegawaiOnDuty)
            {
                $delPegawaiOnDuty = $pegawaiOnDuty->delete();
            }
            $transaksi=TransaksiPenjualan::find($id);
            $transaksi->delete();
            return response()->json('Success',200);
        } catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('transaksi_not_found');
        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }
    public function createSV(request $request)
    {
        try {
            date_default_timezone_set('Asia/Jakarta');
            //$service = $request->get('Detil_TransaksiService');
            //$service = array();
            //$sparepart = $request->get('Detil_TransaksiSparepart');
            //$pegawai = $request->get('Pegawai');
            $transaksi = new TransaksiPenjualan;
            
            $id = array();

            $id = DB::select('select kode_transaksi from transaksi_penjualans order by substring(kode_transaksi, 11) + 0 desc limit 1');
            if(!$id)
                $no = 1;
            else {
                $no_str = substr($id[0]->kode_transaksi, 10);
                $no = ++$no_str;
            }
            $transaksi->id_cabang_fk=$request->id_cabang_fk;
            $transaksi->kode_transaksi='SV'.'-'.date("d").date("m").date("y").'-'.$no;
            $transaksi->tgl_transaksi=date("Y-m-d").' '.date('H:i:s');
            $transaksi->diskon=$request->diskon;
            $transaksi->total_transaksi=$request->total_transaksi;
            $transaksi->status_transaksi="Belum Lunas";
            
            $transaksi->save();

            
            // $transaksi = DB::transaction(function () use ($transaksi,$pegawai) {
            //     $transaksi->pegawai_onduty()->attach($pegawai);
            //     return $transaction;
            // });

            // $transaksi = DB::transaction(function () use ($transaksi,$service) {
            //     $transaksi->detil_transaksi_service()->createMany($service);
            //     return $transaksi;
            // });
            // $transaksi = DB::transaction(function () use ($transaksi,$sparepart) {
            //     $transaksi->detil_transaksi_sparepart()->createMany($sparepart);
            //     return $transaksi;
            // });
            $response = $this->generateItem($transaksi);
            return $this->sendResponse($response, 201);
        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }

    public function createSP(request $request)
    {
        try {
            date_default_timezone_set('Asia/Jakarta');
            // $service = $request->get('Detil_TransaksiService');
            // $sparepart = $request->get('Detil_TransaksiSparepart');
            // $pegawai = $request->get('Pegawai');
            $transaksi = new TransaksiPenjualan;
            $id = array();

            $id = DB::select('select kode_transaksi from transaksi_penjualans order by substring(kode_transaksi, 11) + 0 desc limit 1');
            if(!$id)
                $no = 1;
            else {
                $no_str = substr($id[0]->kode_transaksi, 10);
                $no = ++$no_str;
            }
            $transaksi->id_cabang_fk=$request->id_cabang_fk;
            $transaksi->kode_transaksi='SP'.'-'.date("d").date("m").date("y").'-'.$no;
            $transaksi->tgl_transaksi=date("Y-m-d").' '.date('H:i:s');
            $transaksi->diskon=$request->diskon;
            $transaksi->total_transaksi=$request->total_transaksi;
            $transaksi->status_transaksi="Belum Lunas";
            
            $transaksi->save();

            // $transaction = DB::transaction(function () use ($transaksi,$pegawai) {
            //     $transaction->employees()->attach($pegawai);
            //     return $transaction;
            // });

            // $transaksi = DB::transaction(function () use ($transaksi,$service) {
            //     $transaksi->detil_transaksi_service()->createMany($service);
            //     return $transaksi;
            // });
            // $transaksi = DB::transaction(function () use ($transaksi,$sparepart) {
            //     $transaksi->detil_transaksi_sparepart()->createMany($sparepart);
            //     return $transaksi;
            // });
            $response = $this->generateItem($transaksi);
            return $this->sendResponse($response, 201);
        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }

    public function createSS(request $request)
    {
        try {
            date_default_timezone_set('Asia/Jakarta');
            $service = $request->get('Detil_TransaksiService');
            $sparepart = $request->get('Detil_TransaksiSparepart');
            $pegawai = $request->get('Pegawai');
            $transaksi = new TransaksiPenjualan;
            $id = array();
            $id = DB::select('select kode_transaksi from transaksi_penjualans order by substring(kode_transaksi, 11) + 0 desc limit 1');
            if(!$id)
                $no = 1;
            else {
                $no_str = substr($id[0]->kode_transaksi, 10);
                $no = ++$no_str;
            }
            $transaksi->id_cabang_fk=$request->id_cabang_fk;
            $transaksi->kode_transaksi='SS'.'-'.date("d").date("m").date("y").'-'.$no;
            $transaksi->tgl_transaksi=date("Y-m-d").' '.date('H:i:s');
            $transaksi->diskon=$request->diskon;
            $transaksi->total_transaksi=$request->total_transaksi;
            $transaksi->status_transaksi="Belum Lunas";
            
            $transaksi->save();

            // $transaction = DB::transaction(function () use ($transaksi,$pegawai) {
            //     $transaction->employees()->attach($pegawai);
            //     return $transaction;
            // });

            // $transaksi = DB::transaction(function () use ($transaksi,$service) {
            //     $transaksi->detil_transaksi_service()->createMany($service);
            //     return $transaksi;
            // });
            // $transaksi = DB::transaction(function () use ($transaksi,$sparepart) {
            //     $transaksi->detil_transaksi_sparepart()->createMany($sparepart);
            //     return $transaksi;
            // });
            $response = $this->generateItem($transaksi);
            return $this->sendResponse($response, 201);
        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }
   
    public function showById($id_transaksi)
    {
        try {
            $transaksi=TransaksiPenjualan::find($id_transaksi);
            $response = $this->generateItem($transaksi);
            return $this->sendResponse($response);
        } catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('$transaksi_not_found');
        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }

    //gabisa
    public function showSudahLunas()
    {
        $sudahLunas = "Sudah Lunas";
        $transaksi1 = TransaksiPenjualan::where('status_transaksi',$sudahLunas)->get();
        $response = $this->generateCollection($transaksi1);
        return $this->sendResponse($response,201);

        // $sparepart = SparepartCabang::where('id_cabang_fk',$id)->get();
        // $response = $this->generateCollection($sparepart);
        // return $this->sendResponse($response,201);
    }

    //tcp 3 belom bisa
    public function update(request $request, $id_transaksi)
    {
        try {
            date_default_timezone_set('Asia/Jakarta');
            $service = $request->get('service');
            $sparepart = $request->get('sparepart');
            $transaksi = TransaksiPenjualan::find($id);
            // $transaksi->detail_services()->delete();
            // $transaksi->detail_spareparts()->delete();
            if($request->get('transaction_type')!=$transaksi->transaction_type)
            {
                $count = Transaction::get()
                ->count();
    
                if($request->get('transaction_type')=='Service')
                {
                    $transaksi->id_transaction='SV'.'-'.date("d").date("m").date("y").'-'.$count;
                }
                else if($request->get('transaction_type')=='Sparepart')
                {
                    $transaksi->id_transaction='SP'.'-'.date("d").date("m").date("y").'-'.$count;
                }
                else if($request->get('transaction_type')=='Service And Sparepart')
                {
                    $transaksi->id_transaction='SS'.'-'.date("d").date("m").date("y").'-'.$count;
                }
            }         
            // $transaksi->transaction_date=date("Y-m-d").' '.date('H:i:s');
            $transaksi->transaction_status=$request->get('transaction_status');
            $transaksi->transaction_paid="unpaid";
            $transaksi->transaction_type=$request->get('transaction_type');
            $transaksi->transaction_discount=0;
            $transaksi->transaction_total=$request->get('transaction_total');
            $transaksi->id_customer=$request->get('id_customer');
            $transaksi->save();
            $transaksi = DB::transaction(function () use ($transaksi,$service) {
                $transaksi->detail_services()->createMany($service);
                return $transaksi;
            });
            $transaksi = DB::transaction(function () use ($transaksi,$sparepart) {
                $transaksi->detail_spareparts()->createMany($sparepart);
                return $transaksi;
            });
            $response = $this->generateItem($transaksi);
            return $this->sendResponse($response, 201);
        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }
   
    public function payment(request $request, $id_transaksi)
    {
        try {
            $transaksi = TransaksiPenjualan::find($id_transaksi);
            $transaksi->status_transaksi="Sudah Lunas";
            $transaksi->diskon=$request->get('diskon');;
            $transaksi->total_transaksi=$request->get('total_transaksi');

            $tempSparepart = SparepartCabang::find($request->id_sparepartCabang_fk);
            $tempSparepart->stokSisa_sparepart -= $request->jumlahBeli_sparepart;

            $tempSparepart->save();
            $transaksi->save();
            $response = $this->generateItem($transaksi);
            return $this->sendResponse($response, 201);
        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }
    public function paymentDesktop(request $request, $id_transaksi)
    {
        try {
            $transaksi = TransaksiPenjualan::find($id_transaksi);
            $transaksi->status_transaksi="Sudah Lunas";
            $transaksi->diskon=$request->get('diskon');;
            $transaksi->total_transaksi=$request->get('total_transaksi');

            // $tempSparepart = SparepartCabang::find($request->id_sparepartCabang_fk);
            // $tempSparepart->stokSisa_sparepart -= $request->jumlahBeli_sparepart;

            //$tempSparepart->save();
            $transaksi->save();
            $response = $this->generateItem($transaksi);
            return $this->sendResponse($response, 201);
        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }

    public function delete($id_transaksi)
    {
        try {
            $transaksi=TransaksiPenjualan::find($id_transaksi);
            $transaksi->delete();
            return response()->json('Success',200);
        } catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('transaksi_not_found');
        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }

    //dari jaya
    function tampilRiwayat() {
        $transaksi = DB::select('select id_transaksi, tgl_transaksi, plat_motorKonsumen, status_service, 
        status_transaksi from transaksi_penjualans join detil_transaksi_services ON transaksi_penjualans.id_transaksi=detil_transaksi_services.id_transaksi_fk 
        join motor_konsumens ON motor_konsumens.id_motorKonsumen=detil_transaksi_services.id_motorKonsumen_fk');
        return response()->json($transaksi, 200);
    }
}
