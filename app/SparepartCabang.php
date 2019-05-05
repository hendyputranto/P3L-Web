<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SparepartCabang extends Model
{
    //
    protected $table = 'sparepart_cabangs';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_sparepartCabang';

    public function pengadaan_sparepart(){
        return $this->hasMany('App\PengadaanSparepart', 'id_pengadaan');
    }

    public function detil_transaksisparepart(){
        return $this->hasMany('App\Detil_TransaksiSparepart', 'id_detilTransaksiSparepart');
    }
    public function sparepart(){
        return $this->belongsTo('App\Sparepart');
    }
    public function cabang(){
<<<<<<< HEAD
        return $this->belongsTo('App\Cabang','id_cabang','id_cabang_fk'); // ini ada sinta edit
=======
        return $this->belongsTo('app\Cabang','id_cabang');
        // return $this->belongsTo('app\Cabang','id_cabang','id_cabang_fk'); // ini ada sinta edit
>>>>>>> 25cc9106987ca0932c48f3884aa9c84bfc277c59
    }
}
