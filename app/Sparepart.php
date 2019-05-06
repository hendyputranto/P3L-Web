<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    protected $table = 'spareparts';      //mendefine tabel yang digunakan
    protected $primaryKey = 'kode_sparepart';
    public $incrementing = false;
    
    public function sparepart_cabang(){
        return $this->hasMany('App\SparepartCabang','kode_sparepart_fk', 'kode_sparepart');
    }

    public function motor(){
        return $this->hasMany('App\Motor', 'kode_sparepart');
    }
}
