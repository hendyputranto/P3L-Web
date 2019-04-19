<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Konsumen;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Transformers\KonsumenTransformer;

class KonsumenController extends RestController
{
    protected $transformer = KonsumenTransformer::class;

    ////menampilkan data
    public function show(){
        $konsumen = Konsumen::all();
        $response = $this->generateCollection($konsumen);
        return $this->sendResponse($response);
    }

    //tampil by id
    public function showById(request $request, $id_konsumen){
        $konsumen = Konsumen::find($id_konsumen);
        $response = $this->generateItem($konsumen);
        return $this->sendResponse($response);
    }
    //nambah data
    public function create(request $request){
        
        $this->validate($request,[
            'nama_konsumen' => 'required',
            'noTelp_konsumen' => 'required',
            'alamat_konsumen' => 'required',
        ]);   
        try{
            $konsumen = new Konsumen;
            $konsumen->nama_konsumen = $request->nama_konsumen;
            $konsumen->noTelp_konsumen = $request->noTelp_konsumen;
            $konsumen->alamat_konsumen = $request->alamat_konsumen;

            $konsumen->save();
            
            $response = $this->generateItem($konsumen);

            return $this->sendResponse($response,201);
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
        
    }
    //update data
    public function update(request $request, $id_konsumen){
        $nama_konsumen = $request->nama_konsumen;
        $noTelp_konsumen = $request->noTelp_konsumen;
        $alamat_konsumen = $request->alamat_konsumen;

        try{
            $konsumen = Konsumen::find($id_konsumen);
            $konsumen->nama_konsumen = $nama_konsumen;
            $konsumen->noTelp_konsumen = $noTelp_konsumen;
            $konsumen->alamat_konsumen = $alamat_konsumen;
            
            $konsumen->save();

            $response = $this->generateItem($konsumen);

            return $this->sendResponse($response,201);
        }catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('konsumen_not_found');
        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
        
    }

    //hapus data
    public function delete($id_konsumen){
        try{
        $konsumen = Konsumen::find($id_konsumen);
        $konsumen->delete();

            return response()->json('Successs', 201);
        }catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('konsumen_tidak_ditemukan');
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
    }
}
