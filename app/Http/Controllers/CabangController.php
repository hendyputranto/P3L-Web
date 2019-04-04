<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cabang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Transformers\CabangTransformer;

class CabangController extends RestController
{
    protected $transformer = CabangTransformer::class;
   //menampilkan data
    public function show(){
        return Cabang::all();
        $response = $this->generateCollection($cabang);
        return $this->sendResponse($response);
    }

    //tampil by id
    public function showById(request $request, $id_cabang){
        $cabang = Cabang::find($id_cabang);
        $response = $this->generateItem($cabang);
        return $this->sendResponse($response);
    }
    //nambah data
    public function create(request $request){
        
        $this->validate($request,[
            'nama_cabang' => 'required',
            'alamat_cabang' => 'required',
            'noTelp_cabang' => 'required',
        ]);   
        try{
            $cabang = new Cabang;
            $cabang->nama_cabang = $request->nama_cabang;
            $cabang->alamat_cabang = $request->alamat_cabang;
            $cabang->noTelp_cabang = $request->noTelp_cabang;
            $cabang->save();

            $response = $this->generateItem($cabang);

            return $this->sendResponse($response, 201);
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
        
    }
    //update data
    public function update(request $request, $id_cabang){
        $nama_cabang = $request->nama_cabang;
        $alamat_cabang = $request->alamat_cabang;
        $noTelp_cabang = $request->noTelp_cabang;

        try{
            $cabang = Cabang::find($id_cabang);
            $cabang->nama_cabang = $nama_cabang;
            $cabang->alamat_cabang = $alamat_cabang;
            $cabang->noTelp_cabang = $noTelp_cabang;
            $cabang->save();

            $response = $this->generateItem($cabang);

            return $this->sendResponse($response, 201);
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('cabang_tidak_ditemukan');
        }
        
    }

    //hapus data
    public function delete($id_cabang){
        try{
            $cabang = Cabang::find($id_cabang);
            $cabang->delete();

            return response()->json('Successs', 201);
        }catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('cabang_tidak_ditemukan');
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
    
    }
}
