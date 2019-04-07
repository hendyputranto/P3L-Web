<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JasaService;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Transformers\JasaServiceTransformer;

class JasaServiceController extends RestController
{
    protected $transformer = JasaServiceTransformer::class;

    ////menampilkan data
    public function show(){
        $jasaService = JasaService::all();
        $response = $this->generateCollection($jasaService);
        return $this->sendResponse($response);
    }

    //tampil by id
    public function showById(request $request, $id_jasaService){
        $jasaService = JasaService::find($id_jasaService);
        $response = $this->generateItem($jasaService);
        return $this->sendResponse($response);
    }
    //nambah data
    public function create(request $request){
        
        $this->validate($request,[
            'nama_jasaService' => 'required',
            'harga_jasaService' => 'required',
        ]);   
        try{
            $jasaService = new JasaService;
            $jasaService->nama_jasaService = $request->nama_jasaService;
            $jasaService->harga_jasaService = $request->harga_jasaService;

            $jasaService->save();
            
            $response = $this->generateItem($jasaService);

            return $this->sendResponse($response,201);
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
        
    }
    //update data
    public function update(request $request, $id_jasaService){
        $nama_jasaService = $request->nama_jasaService;
        $harga_jasaService = $request->harga_jasaService;

        try{
            $jasaService = JasaService::find($id_jasaService);
            $jasaService->nama_jasaService = $nama_jasaService;
            $jasaService->harga_jasaService = $harga_jasaService;
            
            $jasaService->save();

            $response = $this->generateItem($jasaService);

            return $this->sendResponse($response,201);
        }catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('branch_not_found');
        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
        
    }

    //hapus data
    public function delete($id_jasaService){
        try{

        
        $jasaService = JasaService::find($id_jasaService);
        $jasaService->delete();

            return response()->json('Successs', 201);
        }catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('cabang_tidak_ditemukan');
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
    }
}
