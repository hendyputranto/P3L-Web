<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    //
    protected $table = 'spareparts';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_sparepart';

    public function sparepart(){
        return $this->belongsTo('app\Sparepart');
    }
}
