<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    protected $table = 'spareparts';      //mendefine tabel yang digunakan
    protected $primaryKey = 'kode_sparepart';

    public function sparepart_cabang(){
        return $this->hasMany('app\SparepartCabang', 'kode_sparepart');
    }

    public function motor(){
        return $this->hasMany('app\Motor', 'kode_sparepart');
    }
}
