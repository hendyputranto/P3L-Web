<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SparepartCabang extends Model
{
    //
    protected $table = 'sparepart_cabangs';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_sparepartCabang';

    public function pengadaan_sparepart(){
        return $this->hasMany('app\PengadaanSparepart', 'id_pengadaan');
    }

    public function detil_transaksisparepart(){
        return $this->hasMany('app\Detil_TransaksiSparepart', 'id_detilTransaksiSparepart');
    }
}
