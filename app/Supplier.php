<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
    protected $table = 'suppliers';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_supplier';

    public function pengadaan_sparepart(){
        return $this->hasMany('App\PengadaanSparepart', 'id_pengadaan');
    }
}
