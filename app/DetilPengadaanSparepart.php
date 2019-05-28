<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetilPengadaanSparepart extends Model
{
    protected $table = 'detil_pengadaan_spareparts';      //mendefine tabel yang digunakan
    protected $primaryKey = 'id_detilPengadaanSparepart';
    protected $fillable = [
        'id_pengadaan_fk',
        'id_sparepartCabang_fk',
        'satuan_pengadaan',
        'sub_total_sparepart',
        'totalBarang_datang',
    ];

    public function sparepart_cabang(){
        return $this->belongsTo('App\SparepartCabang','id_sparepartCabang_fk','id_sparepartCabang');
    }
    public function pengadaan_sparepart(){
        return $this->belongsTo('App\PengadaanSparepart','id_pengadaan_fk','id_pengadaan');
    }
}
