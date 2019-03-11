<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai_OnDuty extends Model
{
    protected $table = 'pegawai_on_duties';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_pegawaiOnDuty';

    public function pegawai(){
        return $this->belongsTo('app\Pegawai');
    }
    public function transaksi_penjualan(){
        return $this->belongsTo('app\TransaksiPenjualan');
    }
}
