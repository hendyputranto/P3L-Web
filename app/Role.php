<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $table = 'roles';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_role';

    public function pegawai(){
        return $this->hasMany('app\Pegawai', 'id_role');
    }
}
