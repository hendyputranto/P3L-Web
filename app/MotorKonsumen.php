<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MotorKonsumen extends Model
{
    protected $table = 'motor_konsumens';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_motorKonsumen';

    public function detil_transaksi_sparepart(){
        return $this->hasMany('App\Detil_TransaksiSparepart', 'id_motorKonsumen');
    }
    public function detil_transaksi_service(){
        return $this->hasMany('App\Detil_TransaksiService', 'id_motorKonsumen');
    }
    public function montir_on_duty(){
        return $this->hasMany('App\Montir_OnDuty', 'id_motorKonsumen');
    }

    public function motor(){
<<<<<<< HEAD
        return $this->belongsTo('App\Motor');
=======
        return $this->belongsTo('App\Motor','id_motor_fk','id_motor');
        //id_motor_fk -> ini foreign key dari Motor Konsumen, biar dia bisa dihubungkan di tabel motor.
>>>>>>> 25cc9106987ca0932c48f3884aa9c84bfc277c59
    }

    public function konsumen(){
        return $this->belongsTo('App\Konsumen');
    }
}

