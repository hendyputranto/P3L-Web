<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detil_TransaksiService extends Model
{
    protected $table = 'detil_transaksi_services';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_detilTransaksiService';

    public function jasa_service(){
        return $this->belongsTo('App\JasaService');
    }
    public function transaksi_penjualan(){
        return $this->belongsTo('App\TransaksiPenjualan');
    }
    public function motor_konsumen(){
        return $this->belongsTo('App\MotorKonsumen');
    }
}
