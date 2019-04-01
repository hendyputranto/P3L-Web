<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;

class SupplierController extends Controller
{
     //menampilkan data
     public function show(){
        return Supplier::all();
    }

    //tampil by id
    public function showById(request $request, $id_supplier){
        $supplier = Supplier::find($id_supplier);
        return $supplier;
    }
    //nambah data
    public function create(request $request){
        $supplier = new Supplier;
        
        $supplier->nama_supplier = $request->nama_supplier;
        $supplier->noTelp_supplier = $request->noTelp_supplier;
        $supplier->alamat_supplier = $request->alamat_supplier;
        $supplier->nama_sales = $request->nama_sales;
        $supplier->noTelp_sales = $request->noTelp_sales;
        
        $supplier->save();

        return "Data berhasil disimpan";
    }
    //update data
    public function update(request $request, $id_supplier){
        $nama_supplier = $request->nama_supplier;
        $alamat_supplier = $request->alamat_supplier;
        $noTelp_supplier = $request->noTelp_supplier;
        $nama_sales = $request->nama_sales;
        $noTelp_sales = $request->noTelp_sales;

        $supplier = Supplier::find($id_supplier);
        $supplier->nama_supplier = $nama_supplier;
        $supplier->noTelp_supplier = $noTelp_supplier;
        $supplier->alamat_supplier = $alamat_supplier;
        $supplier->nama_sales = $nama_sales;
        $supplier->noTelp_sales = $noTelp_sales;
        
        $supplier->save();

        return "Data berhasil Diubah";
    }

    //hapus data
    public function delete($id_supplier){
        $supplier = Supplier::find($id_supplier);
        $supplier->delete();

        return "Data berhasil dihapus";
    }
}
