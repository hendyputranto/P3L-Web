<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konsumen extends Model
{
    protected $table = 'konsumens';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_konsumen';

    public function motor_konsumen(){
        return $this->hasMany('App\MotorKonsumen', 'id_konsumen');
    }

    
    public function detil_transaksi_sparepart(){
        return $this->hasMany('App\Detil_TransaksiSparepart', 'id_konsumen_fk', 'id_konsumen');
    }
    
    

}
