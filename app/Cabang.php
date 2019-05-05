<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    protected $table = 'cabangs';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_cabang';

    protected $fillable = [
        'nama_cabang',
        'alamat_cabang',
        'noTelp_cabang'
    ];
    public function pegawai(){
        return $this->hasMany('App\Pegawai', 'id_cabang');
    }
    public function transaksi_penjualan(){
<<<<<<< HEAD
        return $this->hasMany('App\TransaksiPenjualan', 'id_cabang');
=======
        return $this->hasMany('app\TransaksiPenjualan', 'id_cabang');
    }
    public function sparepart_cabang(){
        return $this->hasMany('app\SparepartCabang', 'id_cabang'); //ini ada sinta edit
        // return $this->hasMany('app\SparepartCabang', 'id_cabang','id_cabang_fk'); //ini ada sinta edit
>>>>>>> 25cc9106987ca0932c48f3884aa9c84bfc277c59
    }
    // public function sparepart_cabang(){
    //     return $this->hasMany('app\SparepartCabang', 'id_cabang','id_cabang_fk'); //ini ada sinta edit
    // }
}
