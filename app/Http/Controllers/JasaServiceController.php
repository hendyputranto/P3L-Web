<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JasaService;

class JasaServiceController extends Controller
{
    ////menampilkan data
    public function show(){
        return JasaService::all();
    }

    //tampil by id
    public function showById(request $request, $id_jasaService){
        return JasaService::all();
    }
    //nambah data
    public function create(request $request){
        $jasaService = new JasaService;
        $jasaService->nama_jasaService = $request->nama_jasaService;
        $jasaService->harga_jasaService = $request->harga_jasaService;

        $jasaService->save();

        return "Data berhasil disimpan";
    }
    //update data
    public function update(request $request, $id_jasaService){
        $nama_jasaService = $request->nama_jasaService;
        $harga_jasaService = $request->harga_jasaService;

        $jasaService = JasaService::find($id_jasaService);
        $jasaService->nama_jasaService = $nama_jasaService;
        $jasaService->harga_jasaService = $harga_jasaService;
        
        $jasaService->save();

        return "Data berhasil Diubah";
    }

    //hapus data
    public function delete($id_jasaService){
        $jasaService = JasaService::find($id_jasaService);
        $jasaService->delete();

        return "Data berhasil dihapus";
    }
}
