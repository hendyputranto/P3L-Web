<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detil_TransaksiSparepart extends Model
{
    //
    protected $table = 'detil_transaksi_spareparts';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_detilTransaksiSparepart';

    protected $fillable = [
        'id_detilTransaksiSparepart',
        'id_transaksi_fk',
        'id_motorKonsumen_fk',
        'jumlahBeli_sparepart',
        'subTotal_sparepart'
    ];
    public function transaksi_penjualan(){
        return $this->belongsTo('App\TransaksiPenjualan', 'id_transaksi_fk','id_transaksi');
    }
    public function motor_konsumen(){
        return $this->belongsTo('App\MotorKonsumen','id_motor_fk', 'id_motor');
    }
    public function sparepart_cabang(){
        return $this->belongsTo('App\SparepartCabang','id_sparepartCabang_fk','id_sparepartCabang');
    }
}
