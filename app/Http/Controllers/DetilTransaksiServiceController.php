<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Detil_TransaksiService;
use App\JasaService;
use App\TransaksiPenjualan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Transformers\DetilTransaksiServiceTransformer;


class DetilTransaksiServiceController extends RestController
{
    //
    protected $transformer = DetilTransaksiServiceTransformer::class;

    ////menampilkan data
    public function show(){
        $detilJasa = Detil_TransaksiService::all();
        $response = $this->generateCollection($detilJasa);
        return $this->sendResponse($response);
    }

    //tampil by id
    public function showById(request $request, $id_detilTransaksiService){
        $detilJasa = Detil_TransaksiService::find($id_detilTransaksiService);
        $response = $this->generateItem($detilJasa);
        return $this->sendResponse($response);
    }
    //tampil by status
    public function showByStatus(){
        $detilJasa = Detil_TransaksiService::where('status_service',"Sudah Selesai")->get();
        $response = $this->generateCollection($detilJasa);
        return $this->sendResponse($response,201);
    }

    //nambah data sinta
    public function createDetilTransaksiService(Request $request){
        try{
            
            $detilTransaksiService = new Detil_TransaksiService;
            
            $detilTransaksiService->id_transaksi_fk = $request->id_transaksi_fk;
            $detilTransaksiService->id_jasaService_fk = $request->id_jasaService_fk;
            $detilTransaksiService->id_motorKonsumen_fk = $request->id_motorKonsumen_fk;
            $detilTransaksiService->subTotal_service = $request->subTotal_service;    
            $detilTransaksiService->status_service = "Belum Selesai";
            $detilTransaksiService->save();
            $response = $this->generateItem($detilTransaksiService, new DetilTransaksiServiceTransformer);
            return $this->sendResponse($response, 201);
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
    }
    //nambah data
    public function create(request $request){
        
        $datas = array();
        $datas = json_decode($request->data);
        //$test = Detil_TransaksiService::where('id_detilTransaksiService', $datas[0]->id_detilTransaksiService)->delete();
        //$subtotal = 0;
        try{
            foreach($datas as $data){
                $detilJasa = new Detil_TransaksiService();
                $detilJasa->id_transaksi_fk = $data->id_transaksi_fk;
                $detilJasa->id_jasaService_fk = $data->id_jasaService_fk;
                $detilJasa->id_motorKonsumen_fk = $data->id_motorKonsumen_fk;
                $detilJasa->status_service = "Belum Selesai";

                //$service = JasaService::find($data->id_jasaService_fk);
                $detilJasa->subTotal_service = $data->subTotal_service;
                $detilJasa->save();
                //$subtotal += $detilJasa->subTotal_service;
               // $response = $this->generateCollection($detilJasa);

            }
                return response()->json(['status' => 'success creating detail penjualan jasa', 'detail_penjualan_jasa' => $detilJasa], 200);
            // $penjualan = TransaksiPenjualan::find($datas[0]->id_detilTransaksiService);
            // $penjualan->total_transaksi = 0 + $subtotal;
            // $penjualan->save();
            // $response = $this->generateItem($penjualan);
            // return $this->sendResponse($response,201);
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
    public function delete($id_detilTransaksiService){
        try{
        $detilJasa = Detil_TransaksiService::find($id_detilTransaksiService);
        $detilJasa->delete();

            return response()->json('Successs', 201);
        }catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('detilJasa_tidak_ditemukan');
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
    }
}
