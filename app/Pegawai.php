<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    //
    protected $table = 'pegawais';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_pegawai';

    public function role(){
        return $this->belongsTo('app\Role');
    }
}
