<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detil_TransaksiSparepart extends Model
{
    //
    protected $table = 'detil_transaksispareparts';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_detilTransaksiSparepart';

    public function role(){
        return $this->belongsTo('app\SparepartCabang');
    }
}
