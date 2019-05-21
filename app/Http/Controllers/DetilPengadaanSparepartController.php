<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetilPengadaanSparepart;
use App\Transformers\DetilPengadaanSparepartTransformer;

class DetilPengadaanSparepartController extends RestController
{
    //
    protected $transformers = DetilPengadaanSparepartTransformer::class;

    public function index()
    {
        $detil = DetilPengadaanSparepart::get();
        $response = $this->generateCollection($detil);
        return $this->sendResponse($response);
    }
    public function createDetilPengadaan(Request $request){
       // dd($request);
        try{
            
            $detilPengadaanSparepart = new DetilPengadaanSparepart;
            
            $detilPengadaanSparepart->id_pengadaan_fk = $request->id_pengadaan_fk;
            $detilPengadaanSparepart->id_sparepartCabang_fk = $request->id_sparepartCabang_fk;
            $detilPengadaanSparepart->satuan_pengadaan = $request->satuan_pengadaan;
            $detilPengadaanSparepart->sub_total_sparepart = $request->sub_total_sparepart;    
            $detilPengadaanSparepart->totalBarang_datang = 0;
            
            $detilPengadaanSparepart->save();
            $response = $this->generateItem($detilPengadaanSparepart, new DetilPengadaanSparepartTransformer);
            return $this->sendResponse($response, 201);
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
    }
    //menampilkan data
    public function show(){
        $detilPengadaanSparepart = DetilPengadaanSparepart::all();
        // dd($detilPengadaanSparepart);
        $response = $this->generateCollection($detilPengadaanSparepart, new DetilPengadaanSparepartTransformer);
        // dd($response);
        return $this->sendResponse($response);
    }

    //tampil by id
    public function showByIdPengadaan($id_pengadaan_fk){
        $detilPengadaanSparepart = DetilPengadaanSparepart::where('id_pengadaan_fk',$id_pengadaan_fk)->get();
        $response = $this->generateCollection($detilPengadaanSparepart, new DetilPengadaanSparepartTransformer);
        return $this->sendResponse($response,201);
    }
}
