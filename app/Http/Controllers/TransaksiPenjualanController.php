<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransaksiPenjualan;
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
    //Buatan sintaa
    public function update_status_transaksi_sinta($id)
    {
        $status_transaksi = "Sudah Selesai";
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
        $diskon = $request->diskon;
        $total_transaksi = $request->total_transaksi;
        try {
            $transaksi = TransaksiPenjualan::find($id);
            $transaksi->diskon = $diskon;
            $transaksi->total_transaksi = $total_transaksi;
            
            $transaksi->save();
            $response = $this->generateItem($transaksi);
            return $this->sendResponse($response, 201);
        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }
    public function createTransaksiPenjualan_sinta(request $request)
    {
        try{
            date_default_timezone_set('Asia/Jakarta');
            $transaksiPenjualan = new TransaksiPenjualan;
            $detil = $request->detil;

            $transaksiPenjualan->id_cabang_fk = $request->id_cabang_fk;
            $id = array();
            
            $id = DB::select('select kode_transaksi from transaksi_penjualans order by substring(kode_transaksi, 11) + 0 desc limit 1');
            if(!$id)
                $no = 1;
            else {
                $no_str = substr($id[0]->kode_transaksi, 10);
                $no = ++$no_str;
            }
            
            $transaksiPenjualan->id_cabang_fk=$request->id_cabang_fk;
            $transaksiPenjualan->kode_transaksi='SP'.'-'.date("d").date("m").date("y").'-'.$no;
            $transaksiPenjualan->tgl_transaksi = date("Y-m-d").' '.date('H:i:s');
            $transaksiPenjualan->diskon = $request->diskon;
            $transaksiPenjualan->total_transaksi = $request->total_transaksi;
            $transaksiPenjualan->status_transaksi = "Belum Lunas";
            
            $transaksiPenjualan->save();
            $transaksiPenjualan = DB::transaction(function()use($transaksiPenjualan,$detil){
                $transaksiPenjualan->detil_transaksi_sparepart()->createMany($detil);
                return $transaksiPenjualan;
                //input data dalam bentuk array 2d, meskipun datanya cuma 1. 
            });

            $response = $this->generateItem($transaksiPenjualan);

            return $this->sendResponse($response, 201);

        }catch(\Exception $e){
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
            $transaksi->status_transaksi=$request->status_transaksi;
            
            $transaksi->save();

            $transaction = DB::transaction(function () use ($transaksi,$pegawai) {
                $transaction->employees()->attach($pegawai);
                return $transaction;
            });

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

    public function showSudahLunas()
    {
        $sudahLunas = "Sudah Lunas";
        $transaksi = TransaksiPenjualan::where('status_transaksi',$sudahLunas)->get();
        $response = $this->generateCollection($transaksi);
        return $this->sendResponse($response);
    }

    //tcp 3
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
}
