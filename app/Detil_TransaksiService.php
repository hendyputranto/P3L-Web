<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detil_TransaksiService extends Model
{
    protected $table = 'detil_transaksi_services';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_detilTransaksiService';

    protected $fillable = [
        'id_detilTransaksiService',
        'id_transaksi_fk',
        'id_jasaService_fk',
        'id_motorKonsumen_fk',
        'subTotal_service',
        'status_service'
    ];
    public function jasa_service(){
        return $this->belongsTo('App\JasaService', 'id_jasaService_fk', 'id_jasaService');
    }
    public function transaksi_penjualan(){
        return $this->belongsTo('App\TransaksiPenjualan', 'id_transaksi_fk','id_transaksi');
    }
    public function motor_konsumen(){
        return $this->belongsTo('App\MotorKonsumen');
    }
}
