<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Transformers\SupplierTransformer;

class SupplierController extends RestController
{
    protected $transformer = SupplierTransformer::class;
     //menampilkan data
     public function show(){
        return Supplier::all();
        $response = $this->generateCollection($supplier);
        return $this->sendResponse($response);
    }

    //tampil by id
    public function showById(request $request, $id_supplier){
        $supplier = Supplier::find($id_supplier);
        $response = $this->generateItem($supplier);
        return $this->sendResponse($response);
    }
    //nambah data
    public function create(request $request){
        $this->validate($request,[
            'nama_supplier' => 'required',
            'noTelp_supplier' => 'required',
            'alamat_supplier' => 'required',
            'nama_sales' => 'required',
            'noTelp_sales' => 'required',
        ]);
        try{
            $supplier = new Supplier;
        
            $supplier->nama_supplier = $request->nama_supplier;
            $supplier->noTelp_supplier = $request->noTelp_supplier;
            $supplier->alamat_supplier = $request->alamat_supplier;
            $supplier->nama_sales = $request->nama_sales;
            $supplier->noTelp_sales = $request->noTelp_sales;
            
            $supplier->save();

            $response = $this->generateItem($supplier);

            return $this->sendResponse($response, 201);
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
        
    }
    //update data
    public function update(request $request, $id_supplier){
        $nama_supplier = $request->nama_supplier;
        $alamat_supplier = $request->alamat_supplier;
        $noTelp_supplier = $request->noTelp_supplier;
        $nama_sales = $request->nama_sales;
        $noTelp_sales = $request->noTelp_sales;

        try{
            $supplier = Supplier::find($id_supplier);
            $supplier->nama_supplier = $nama_supplier;
            $supplier->noTelp_supplier = $noTelp_supplier;
            $supplier->alamat_supplier = $alamat_supplier;
            $supplier->nama_sales = $nama_sales;
            $supplier->noTelp_sales = $noTelp_sales;
            
            $supplier->save();
    
            $response = $this->generateItem($supplier);

            return $this->sendResponse($response, 201);
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('supplier_tidak_ditemukan');
        }
        
    }

    //hapus data
    public function delete($id_supplier){
        
        try{
            $supplier = Supplier::find($id_supplier);
            $supplier->delete();

            return response()->json('Successs', 201);
        }catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('supllier_tidak_ditemukan');
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
        
    }
}
