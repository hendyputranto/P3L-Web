<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiPenjualan extends Model
{
    //
    protected $table = 'transaksi_penjualans';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_transaksi';

    public function pegawai(){
        return $this->hasMany('app\Pegawai_OnDuty', 'id_pegawaiOnDuty');
    }
}
