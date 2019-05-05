<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Montir_OnDuty extends Model
{
    //
    protected $table = 'montir__on_duties';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_montirOnDuty';
    public function pegawai(){
        return $this->belongsTo('App\Pegawai');
    }

    public function motor_konsumen(){
        return $this->belongsTo('App\MotorKonsumen');
    }
}
