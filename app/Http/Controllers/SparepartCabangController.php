<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SparepartCabang;

class SparepartCabangController extends Controller
{
   //menampilkan data
     public function show(){
        return SparepartCabang::all();
    }

    //tampil by id
    public function showById(request $request, $id_sparepartCabang){
        $sparepartCabang = SparepartCabang::find($id_sparepartCabang);
        return $sparepartCabang;
    }
    //nambah data
    public function create(request $request){
        $sparepartCabang = new SparepartCabang;
        
        $sparepartCabang->id_cabang_fk = $request->id_cabang_fk;
        $sparepartCabang->kode_sparepart_fk = $request->kode_sparepart_fk;
        $sparepartCabang->hargaBeli_sparepart = $request->hargaBeli_sparepart;
        $sparepartCabang->hargaJual_sparepart = $request->hargaJual_sparepart;
        $sparepartCabang->letak_sparepart = $request->letak_sparepart;
        $sparepartCabang->stokMin_sparepart = $request->stokMin_sparepart;
        $sparepartCabang->stokSisa_sparepart = $request->stokSisa_sparepart;
        
        $sparepartCabang->save();

        return "Data berhasil disimpan";
    }
    //update data
    public function update(request $request, $id_sparepartCabang){
        $id_cabang_fk = $request->id_cabang_fk;
        $kode_sparepart_fk = $request->kode_sparepart_fk;
        $hargaBeli_sparepart = $request->hargBeli_sparepart;
        $hargaJual_sparepart = $request->hargaJual_sparepart;
        $letak_sparepart = $request->letak_sparepart;
        $stokMin_sparepart = $request->stokMin_sparepart;
        $stokSisa_sparepart = $request->stokSisa_sparepart;

        $sparepartCabang = SparepartCabang::find($id_sparepartCabang);
        $sparepartCabang->id_cabang_fk = $id_cabang_fk;
        $sparepartCabang->kode_sparepart_fk = $kode_sparepart_fk;
        $sparepartCabang->hargaBeli_sparepart = $hargaBeli_sparepart;
        $sparepartCabang->hargaJual_sparepart = $hargaJual_sparepart;
        $sparepartCabang->letak_sparepart = $letak_sparepart;
        $sparepartCabang->stokMin_sparepart = $stokMin_sparepart;
        $sparepartCabang->stokSisa_sparepart = $stokSisa_sparepart;
        
        $sparepartCabang->save();

        return "Data berhasil Diubah";
    }

    //hapus data
    public function delete($id_sparepartCabang){
        $sparepartCabang = SparepartCabang::find($id_sparepartCabang);
        $sparepartCabang->delete();

        return "Data berhasil dihapus";
    }
}
