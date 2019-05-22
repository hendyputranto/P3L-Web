<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai_OnDuty extends Model
{
    protected $table = 'pegawai_on_duties';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_pegawaiOnDuty';
    protected $fillable = [
        'id_pegawai_fk',
        'id_transaksi_fk'
    ];

    public function pegawai(){
        return $this->belongsTo('App\Pegawai', 'id_pegawai_fk', 'id_pegawai');
    }
    public function transaksi_penjualan(){
        return $this->belongsTo('App\TransaksiPenjualan', 'id_transaksi_fk', 'id_transaksi');
    }
}
