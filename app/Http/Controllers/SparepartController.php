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
        $sparepart = Sparepart::all();
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

        try{
            $sparepart = new Sparepart;
        
            if($request->hasfile('gambar_sparepart'))
            {
                $file = $request->file('gambar_sparepart');
                $name=time().$file->getClientOriginalName();
                $file->move(public_path().'/images/', $name);
                $sparepart->gambar_sparepart=$name;
            }else
            {
                $sparepart->gambar_sparepart = NULL;
            }

            $sparepart->kode_sparepart = $request->kode_sparepart;
            $sparepart->nama_sparepart = $request->nama_sparepart;
            $sparepart->merk_sparepart = $request->merk_sparepart;
            $sparepart->tipe_sparepart = $request->tipe_sparepart;
            // $sparepart->gambar_sparepart = $request->gambar_sparepart;
            
            $sparepart->save();

            $response = $this->generateItem($sparepart);

            return $this->sendResponse($response, 201);
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
        
    }
    //update data
    public function update(request $request, $kode_sparepart){

        try{
            $sparepart = Sparepart::find($kode_sparepart);

            if($request->hasfile('gambar_sparepart'))
            {
                $file = $request->file('gambar_sparepart');
                $name=time().$file->getClientOriginalName();
                $file->move(public_path().'/images/', $name);
                $sparepart->gambar_sparepart=$name;
            }
            $sparepart->kode_sparepart = $request->kode_sparepart;
            $sparepart->nama_sparepart = $request->nama_sparepart;
            $sparepart->merk_sparepart = $request->merk_sparepart;
            $sparepart->tipe_sparepart = $request->tipe_sparepart;
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
