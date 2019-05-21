<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    //
    protected $table = 'pegawais';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_pegawai';

    public function role(){
        return $this->belongsTo('App\Role', 'id_role_fk', 'id_role');
    }
    public function cabang(){
        return $this->belongsTo('App\Cabang');
    }

    public function montir_onduty(){
        return $this->hasMany('App\Montir_OnDuty', 'id_pegawai');
    }
    public function pegawai_onduty(){
        return $this->hasMany('App\Pegawai_OnDuty', 'id_pegawai');
    }
}
