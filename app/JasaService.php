<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JasaService extends Model
{
    protected $table = 'jasa_services';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_jasaService';

    public function detil_transaksi_service(){
        return $this->hasMany('App\Detil_TransaksiService', 'id_jasaService_fk', 'id_jasaService');
    }
}
