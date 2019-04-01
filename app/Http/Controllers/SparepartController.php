<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sparepart;

class SparepartController extends Controller
{
     //menampilkan data
     public function show(){
        return Sparepart::all();
    }

    //tampil by id
    public function showById(request $request, $kode_sparepart){
        $sparepart = Sparepart::find($kode_sparepart);
        return $sparepart;
    }
    //nambah data
    public function create(request $request){
        $sparepart = new Sparepart;
        
        $sparepart->kode_sparepart = $request->kode_sparepart;
        $sparepart->nama_sparepart = $request->nama_sparepart;
        $sparepart->merk_sparepart = $request->merk_sparepart;
        $sparepart->tipe_sparepart = $request->tipe_sparepart;
        $sparepart->gambar_sparepart = $request->gambar_sparepart;
        
        $sparepart->save();

        return "Data berhasil disimpan";
    }
    //update data
    public function update(request $request, $kode_sparepart){
        $kode_sparepart = $request->kode_sparepart;
        $nama_sparepart = $request->nama_sparepart;
        $merk_sparepart = $request->merk_sparepart;
        $tipe_sparepart = $request->tipe_sparepart;
        $gambar_sparepart = $request->gambar_sparepart;

        $sparepart = Sparepart::find($kode_sparepart);
        $sparepart->kode_sparepart = $kode_sparepart;
        $sparepart->nama_sparepart = $nama_sparepart;
        $sparepart->merk_sparepart = $merk_sparepart;
        $sparepart->tipe_sparepart = $tipe_sparepart;
        $sparepart->gambar_sparepart = $gambar_sparepart;
        
        $sparepart->save();

        return "Data berhasil Diubah";
    }

    //hapus data
    public function delete($kode_sparepart){
        $sparepart = Sparepart::find($kode_sparepart);
        $sparepart->delete();

        return "Data berhasil dihapus";
    }
}
