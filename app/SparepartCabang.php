<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SparepartCabang extends Model
{
    //
    protected $table = 'sparepart_cabangs';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_sparepartCabang';

    // public function pengadaan_sparepart(){
    //     return $this->hasMany('app\PengadaanSparepart', 'id_pengadaan');
    // }

    public function detil_transaksisparepart(){
        return $this->hasMany('App\Detil_TransaksiSparepart', 'id_detilTransaksiSparepart_fk','id_detilTransaksiSparepart_fk');
    }
    public function sparepart(){
        return $this->belongsTo('App\Sparepart','kode_sparepart_fk', 'kode_sparepart');
    }
    public function cabang(){
        return $this->belongsTo('App\Cabang','id_cabang_fk','id_cabang');
    }
    public function detil_pengadaansparepart(){
        return $this->hasMany('app\DetilPengadaanSparepart','id_sparepartCabang_fk','id_sparepartCabang');
    }
}
