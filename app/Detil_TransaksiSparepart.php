<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detil_TransaksiSparepart extends Model
{
    //
    protected $table = 'detil_transaksi_spareparts';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_detilTransaksiSparepart';

    public function transaksi_penjualan(){
        return $this->belongsTo('app\TransaksiPenjualan');
    }
    public function motor_konsumen(){
        return $this->belongsTo('app\MotorKonsumen');
    }
    public function sparepart_cabang(){
        return $this->belongsTo('app\SparepartCabang');
    }
}
