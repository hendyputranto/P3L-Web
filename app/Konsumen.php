<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konsumen extends Model
{
    protected $table = 'konsumens';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_konsumen';

    public function motor_konsumen(){
        return $this->hasMany('app\MotorKonsumen', 'id_konsumen');
    }
}
