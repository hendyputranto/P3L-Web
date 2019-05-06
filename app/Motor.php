<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    //
    protected $table = 'motors';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_motor';

<<<<<<< HEAD
    public function sparepart(){
        return $this->belongsTo('App\Sparepart');
    }
=======
    // public function sparepart(){
    //     return $this->belongsTo('app\Sparepart');
    // }
>>>>>>> 25cc9106987ca0932c48f3884aa9c84bfc277c59
    public function motor_konsumen(){
        return $this->hasMany('App\MotorKonsumen', 'id_motor');
    }
}
