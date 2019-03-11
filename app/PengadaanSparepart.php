<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengadaanSparepart extends Model
{
    //
    protected $table = 'pengadaan_spareparts';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_pengadaan';

    public function supplier(){
        return $this->belongsTo('app\Supplier');
    }

    public function sparepart_cabang(){
        return $this->belongsTo('app\SparepartCabang');
    }
}
