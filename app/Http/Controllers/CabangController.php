<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cabang;

class CabangController extends Controller
{
   //menampilkan data
    public function show(){
        return Cabang::all();
    }

    //tampil by id
    public function showById(request $request, $id_cabang){
        $cabang = Cabang::find($id_cabang);
        return $cabang;
    }
    //nambah data
    public function create(request $request){
        $cabang = new Cabang;
        $cabang->nama_cabang = $request->nama_cabang;
        $cabang->alamat_cabang = $request->alamat_cabang;
        $cabang->noTelp_cabang = $request->noTelp_cabang;
        $cabang->save();

        return "Data berhasil disimpan";
    }
    //update data
    public function update(request $request, $id_cabang){
        $nama_cabang = $request->nama_cabang;
        $alamat_cabang = $request->alamat_cabang;
        $noTelp_cabang = $request->noTelp_cabang;

        $cabang = Cabang::find($id_cabang);
        $cabang->nama_cabang = $nama_cabang;
        $cabang->alamat_cabang = $alamat_cabang;
        $cabang->noTelp_cabang = $noTelp_cabang;
        $cabang->save();

        return "Data berhasil Diubah";
    }

    //hapus data
    public function delete($id_cabang){
        $cabang = Cabang::find($id_cabang);
        $cabang->delete();

        return "Data berhasil dihapus";
    }
}
