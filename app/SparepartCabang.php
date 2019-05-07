<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SparepartCabang extends Model
{
    //
    protected $table = 'sparepart_cabangs';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_sparepartCabang';


    public function pengadaan_sparepart(){
        return $this->hasMany('App\PengadaanSparepart', 'id_pengadaan_fk','id_pengadaan');
    }

    public function detil_transaksisparepart(){
        return $this->hasMany('App\Detil_TransaksiSparepart', 'id_detilTransaksiSparepart_fk','id_detilTransaksiSparepart_fk');
    }
    public function sparepart(){
        return $this->belongsTo('App\Sparepart','kode_sparepart_fk', 'kode_sparepart');
    }
    public function cabang(){
<<<<<<< HEAD
        return $this->belongsTo('App\Cabang','id_cabang');
        // return $this->belongsTo('app\Cabang','id_cabang','id_cabang_fk'); // ini ada sinta edit
=======
        return $this->belongsTo('App\Cabang','id_cabang_fk','id_cabang');
    }
    public function detil_pengadaansparepart(){
        return $this->hasMany('App\DetilPengadaanSparepart','id_sparepartCabang_fk','id_sparepartCabang');
>>>>>>> 7c842180aea758e1343567b6a35bd8dc63b214ce
    }
}