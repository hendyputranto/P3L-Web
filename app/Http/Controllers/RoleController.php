<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
class RoleController extends Controller
{
    //menampilkan data
    public function show(){
        return Role::all();
    }

    //tampil by id
    public function showById(request $request, $id_role){
        return Role::all();
    }
    //nambah data
    public function create(request $request){
        $role = new Role;
        $role->nama_role = $request->nama_role;
        $role->save();

        return "Data berhasil disimpan";
    }
    //update data
    public function update(request $request, $id_role){
        $nama_role = $request->nama_role;

        $role = Role::find($id_role);
        $role->nama_role = $nama_role;
        $role->save();

        return "Data berhasil Diubah";
    }

    //hapus data
    public function delete($id_role){
        $role = Role::find($id_role);
        $role->delete();

        return "Data berhasil dihapus";
    }
}
