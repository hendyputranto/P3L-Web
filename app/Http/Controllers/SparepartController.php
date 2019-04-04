<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sparepart;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Transformers\SparepartTransformer;

class SparepartController extends RestController
{
    protected $transformer = SparepartTransformer::class;
     //menampilkan data
     public function show(){
        return Sparepart::all();
        $response = $this->generateCollection($sparepart);
        return $this->sendResponse($response);
    }

    //tampil by id
    public function showById(request $request, $kode_sparepart){
        $sparepart = Sparepart::find($kode_sparepart);
        $response = $this->generateItem($sparepart);
        return $this->sendResponse($response);
    }
    //nambah data
    public function create(request $request){
        $this->validate($request,[
            'kode_sparepart' => 'required',
            'nama_sparepart' => 'required',
            'merk_sparepart' => 'required',
            'tipe_sparepart' => 'required',
            'gambar_sparepart' => 'required',
        ]);

        try{
            $sparepart = new Sparepart;
        
            $sparepart->kode_sparepart = $request->kode_sparepart;
            $sparepart->nama_sparepart = $request->nama_sparepart;
            $sparepart->merk_sparepart = $request->merk_sparepart;
            $sparepart->tipe_sparepart = $request->tipe_sparepart;
            $sparepart->gambar_sparepart = $request->gambar_sparepart;
            
            $sparepart->save();

            $response = $this->generateItem($sparepart);

            return $this->sendResponse($response, 201);
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
        
    }
    //update data
    public function update(request $request, $kode_sparepart){
        $kode_sparepart = $request->kode_sparepart;
        $nama_sparepart = $request->nama_sparepart;
        $merk_sparepart = $request->merk_sparepart;
        $tipe_sparepart = $request->tipe_sparepart;
        $gambar_sparepart = $request->gambar_sparepart;

        try{
            $sparepart = Sparepart::find($kode_sparepart);
            $sparepart->kode_sparepart = $kode_sparepart;
            $sparepart->nama_sparepart = $nama_sparepart;
            $sparepart->merk_sparepart = $merk_sparepart;
            $sparepart->tipe_sparepart = $tipe_sparepart;
            $sparepart->gambar_sparepart = $gambar_sparepart;
            
            $sparepart->save();

            $response = $this->generateItem($sparepart);

            return $this->sendResponse($response, 201);
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('sparepart_tidak_ditemukan');
        }
        
    }

    //hapus data
    public function delete($kode_sparepart){
        try{
            $sparepart = Sparepart::find($kode_sparepart);
            $sparepart->delete();

            return response()->json('Successs', 201);
        }catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('cabang_tidak_ditemukan');
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
        

        return "Data berhasil dihapus";
    }
}
