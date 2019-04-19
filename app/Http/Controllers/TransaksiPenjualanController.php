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
    
    public function create(request $request)
    {
        try {
            date_default_timezone_set('Asia/Jakarta');
            $service = $request->get('service');
            $sparepart = $request->get('sparepart');
            $transaksi = new TransaksiPenjualan;
            // $count = TransaksiPenjualan::get()
            // ->count()
            // + 1;
            // if($request->get('transaction_type')=='Service')
            // {
            //     $transaksi->id_transaction='SV'.'-'.date("d").date("m").date("y").'-'.$count;
            // }
            // else if($request->get('transaction_type')=='Sparepart')
            // {
            //     $transaksi->id_transaction='SP'.'-'.date("d").date("m").date("y").'-'.$count;
            // }
            // else if($request->get('transaction_type')=='Service And Sparepart')
            // {
            //     $transaksi->id_transaction='SS'.'-'.date("d").date("m").date("y").'-'.$count;
            // }
            $transaksi->id_cabang_fk=$request->id_cabang_fk;
            $transaksi->kode_transaksi=$request->kode_transaksi;
            $transaksi->tgl_transaksi=date("Y-m-d").' '.date('H:i:s');
            $transaksi->diskon=$request->diskon;
            $transaksi->total_transaksi=$request->total_transaksi;
            $transaksi->status_transaksi=$request->status_transaksi;
            //$transaksi->transaction_paid="unpaid";
            //$transaksi->transaction_type=$request->get('transaction_type');
            //$transaksi->id_customer=$request->get('id_customer');
            $transaksi->save();
            $transaksi = DB::transaction(function () use ($transaksi,$service) {
                $transaksi->detil_transaksi_service()->createMany($service);
                return $transaksi;
            });
            $transaksi = DB::transaction(function () use ($transaksi,$sparepart) {
                $transaksi->detil_transaksi_sparepart()->createMany($sparepart);
                return $transaksi;
            });
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

    public function update(Request $request, $id_transaksi)
    {
        try {
            date_default_timezone_set('Asia/Jakarta');
            $service = $request->get('service');
            $sparepart = $request->get('sparepart');
            $transaksi = Transaction::find($id);
            $transaksi->detail_services()->delete();
            $transaksi->detail_spareparts()->delete();
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
