<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use App\Role;

class PegawaiController extends Controller
{
    //menampilkan data
    public function show(){
        return Pegawai::all();
    }

    //tampil by id
    public function showById(request $request, $id_pegawai){
        $pegawai = Pegawai::find($id_pegawai);
        return $pegawai;
    }
    //nambah data
    public function create(request $request){
        $pegawai = new Pegawai;
        //$role = $request->id_role;
        //$cabang = $request->id_cabang;

        $pegawai->id_role_fk = $request->id_role_fk;
        $pegawai->id_cabang_fk = $request->id_cabang_fk;

        $pegawai->nama_pegawai = $request->nama_pegawai;
        $pegawai->alamat_pegawai = $request->alamat_pegawai;
        $pegawai->noTelp_pegawai = $request->noTelp_pegawai;
        $pegawai->gaji_pegawai = $request->gaji_pegawai;
        $pegawai->username_pegawai = $request->username_pegawai;
        $pegawai->password_pegawai = $request->password_pegawai;
        
        $pegawai->save();

        return "Data berhasil disimpan";
    }
    //update data
    public function update(request $request, $id_pegawai){
        $id_role_fk = $request->id_role_fk;
        $id_cabang_fk = $request->id_cabang_fk;
        $nama_pegawai = $request->nama_pegawai;
        $alamat_pegawai = $request->alamat_pegawai;
        $noTelp_pegawai = $request->noTelp_pegawai;
        $gaji_pegawai = $request->gaji_pegawai;
        $username_pegawai = $request->username_pegawai;
        $password_pegawai = $request->password_pegawai;

        $pegawai = Pegawai::find($id_pegawai);
        $pegawai->id_role_fk = $id_role_fk;
        $pegawai->id_cabang_fk = $id_cabang_fk;
        $pegawai->nama_pegawai = $nama_pegawai;
        $pegawai->alamat_pegawai = $alamat_pegawai;
        $pegawai->noTelp_pegawai = $noTelp_pegawai;
        $pegawai->gaji_pegawai = $gaji_pegawai;
        $pegawai->username_pegawai = $username_pegawai;
        $pegawai->password_pegawai = $password_pegawai;

        $pegawai->save();

        return "Data berhasil Diubah";
    }

    //hapus data
    public function delete($id_pegawai){
        $pegawai = Pegawai::find($id_pegawai);
        $pegawai->delete();

        return "Data berhasil dihapus";
    }
}
