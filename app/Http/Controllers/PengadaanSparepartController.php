<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PengadaanSparepart;
class PengadaanSparepartController extends Controller
{
     //menampilkan data
     public function show(){
        return PengadaanSparepart::all();
    }

    //tampil by id
    public function showById(request $request, $id_pengadaan){
        $pengadaanSparepart = PengadaanSparepart::find($id_pengadaan);
        return $pengadaanSparepart;
    }
    //nambah data
    public function create(request $request){
        $pengadaanSparepart = new PengadaanSparepart;
        
        $pengadaanSparepart->id_supplier_fk = $request->id_supplier_fk;
        $pengadaanSparepart->id_sparepartCabang_fk = $request->id_sparepartCabang_fk;
        $pengadaanSparepart->status_pengadaan = $request->status_pengadaan;
        $pengadaanSparepart->satuan_pengadaan = $request->satuan_pengadaan;
        $pengadaanSparepart->totalHarga_pengadaan = $request->totalHarga_pengadaan;
        $pengadaanSparepart->totalBarang_datang = $request->totalBarang_datang;
        $pengadaanSparepart->tgl_pengadaan = $request->tgl_pengadaan;
        $pengadaanSparepart->tgl_barangDatang = $request->tgl_barangDatang;
        $pengadaanSparepart->statusCetak_pengadaan = $request->statusCetak_pengadaan;
        
        $pengadaanSparepart->save();

        return "Data berhasil disimpan";
    }
    //update data
    public function update(request $request, $id_pengadaan){
        $id_supplier_fk = $request->id_supplier_fk;
        $id_sparepartCabang_fk = $request->id_sparepartCabang_fk;
        $status_pengadaan = $request->status_pengadaan;
        $satuan_pengadaan = $request->satuan_pengadaan;
        $totalHarga_pengadaan = $request->totalHarga_pengadaan;
        $totalBarang_datang = $request->totalBarang_datang;
        $tgl_pengadaan = $request->tgl_pengadaan;
        $tgl_barangDatang = $request->tgl_barangDatang;
        $statusCetak_pengadaan = $request->statusCetak_pengadaan;

        $pengadaanSparepart = PengadaanSparepart::find($id_pengadaan);
        $pengadaanSparepart->id_supplier_fk = $id_supplier_fk;
        $pengadaanSparepart->id_sparepartCabang_fk = $id_sparepartCabang_fk;
        $pengadaanSparepart->status_pengadaan = $status_pengadaan;
        $pengadaanSparepart->satuan_pengadaan = $satuan_pengadaan;
        $pengadaanSparepart->totalHarga_pengadaan = $totalHarga_pengadaan;
        $pengadaanSparepart->totalBarang_datang = $totalBarang_datang;
        $pengadaanSparepart->tgl_pengadaan = $tgl_pengadaan;
        $pengadaanSparepart->tgl_barangDatang = $tgl_barangDatang;
        $pengadaanSparepart->statusCetak_pengadaan = $statusCetak_pengadaan;
        
        $pengadaanSparepart->save();

        return "Data berhasil Diubah";
    }

    //hapus data
    public function delete($id_pengadaan){
        $pengadaanSparepart = PengadaanSparepart::find($id_pengadaan);
        $pengadaanSparepart->delete();

        return "Data berhasil dihapus";
    }
}
