<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiPenjualan extends Model
{
    //
    protected $table = 'transaksi_penjualans';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_transaksi';

    public function pegawai_onduty(){
        return $this->hasMany('app\Pegawai_OnDuty', 'id_transaksi');
    }
    public function detil_transaksi_sparepart(){
        return $this->hasMany('app\Detil_TransaksiSparepart', 'id_transaksi');
    }
    public function detil_transaksi_service(){
        return $this->hasMany('app\Detil_TransaksiService', 'id_transaksi');
    }
    public function cabang(){
        return $this->belongsTo('app\Cabang');
    }
}
