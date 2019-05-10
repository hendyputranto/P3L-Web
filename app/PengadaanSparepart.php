<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengadaanSparepart extends Model
{
    //
    protected $table = 'pengadaan_spareparts';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_pengadaan';

    public function supplier(){
        return $this->belongsTo('App\Supplier' , 'id_supplier_fk' , 'id_supplier');
        //yang kiri itu foreign key entah dipake dimana :' D
    }
    public function cabang(){
        return $this->belongsTo('App\Cabang' , 'id_cabang_fk' , 'id_cabang');
        //yang kiri itu foreign key entah dipake dimana :' D
    }
    public function detil_pengadaansparepart(){
        return $this->hasMany('App\DetilPengadaanSparepart','id_pengadaan_fk','id_pengadaan');
    }
}
