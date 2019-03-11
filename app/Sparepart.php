<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    protected $table = 'spareparts';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_sparepart';

    public function sparepart_cabang(){
        return $this->hasMany('app\SparepartCabang', 'id_sparepart');
    }

    public function motor(){
        return $this->hasMany('app\Motor', 'id_sparepart');
    }
}
