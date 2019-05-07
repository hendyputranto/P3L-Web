<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    //
    protected $table = 'motors';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_motor';

    // public function sparepart(){
    //     return $this->belongsTo('app\Sparepart');
    // }
    public function motor_konsumen(){
        return $this->hasMany('App\MotorKonsumen', 'id_motor');
    }
}
