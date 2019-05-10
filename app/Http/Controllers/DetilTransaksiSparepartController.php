<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Detil_TransaksiSparepart;
use App\SparepartCabang;
use App\TransaksiPenjualan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Transformers\DetilTransaksiSparepartTransformer;

class DetilTransaksiSparepartController extends RestController
{
    //
    protected $transformer = DetilTransaksiSparepartTransformer::class;

    ////menampilkan data
    public function show(){
        $detilSparepart = Detil_TransaksiSparepart::all();
        $response = $this->generateCollection($detilSparepart);
        return $this->sendResponse($response);
    }

    //tampil by id
    public function showById(request $request, $id_detilTransaksiSparepart){
        $detilSparepart = Detil_TransaksiSparepart::find($id_detilTransaksiSparepart);
        $response = $this->generateItem($detilSparepart);
        return $this->sendResponse($response);
    }
    //nambah data
    public function create(request $request){
        
        $datas = array();
        $datas = json_decode($request->data);
        $test = Detil_TransaksiSparepart::where('id_detilTransaksiSparepart', $datas[0]->id_detilTransaksiService)->delete();
        $subtotal = 0;
        try{
            foreach($datas as $data){
                $detilSparepart = new Detil_TransaksiSparepart();
                $detilSparepart->id_transaksi_fk = $data->id_transaksi_fk;
                $detilSparepart->id_sparepartCabang_fk = $data->id_sparepartCabang_fk;
                $detilSparepart->id_konsumen_fk = $data->id_konsumen_fk;
                $detilSparepart->jumlahBeli_sparepart = $data->jumlahBeli_sparepart;
                
                $detilSparepart->subTotal_sparepart = $data->subTotal_sparepart;

                $sparepart = SparepartCabang::find($data->id_sparepartCabang_fk);
                $detilSparepart->subTotal_sparepart = $sparepart->hargaJual_sparepart;
                $detilSparepart->save();
                $subtotal += $detilSparepart->subTotal_sparepart;
                $response = $this->generateItem($detilSparepart);

                return $this->sendResponse($response,201);
            }
            $penjualan = TransaksiPenjualan::find($datas[0]->id_detilTransaksiSparepart);
            $penjualan->total_transaksi = 0 + $subtotal;
            $penjualan->save();
            $response = $this->generateItem($penjualan);
            return $this->sendResponse($response,201);
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
        
    }
    //update data masih tcp 3
    public function update(request $request, $id_detilTransaksiService){
        $kode_sparepart_fk = $request->kode_sparepart_fk;
        $merk_motor = $request->merk_motor;
        $tipe_motor = $request->tipe_motor;

        try{
            $motor = Motor::find($id_motor);
            $motor->kode_sparepart_fk = $kode_sparepart_fk;
            $motor->merk_motor = $merk_motor;
            $motor->tipe_motor = $tipe_motor;
            
            $motor->save();

            $response = $this->generateItem($motor);

            return $this->sendResponse($response,201);
        }catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('motor_not_found');
        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
        
    }

    //hapus data
    public function delete($id_detilTransaksiSparepart){
        try{
        $detilSparepart = Detil_TransaksiSparepart::find($id_detilTransaksiSparepart);
        $detilSparepart->delete();

            return response()->json('Successs', 201);
        }catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('detilSparepart_tidak_ditemukan');
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
    }
}
