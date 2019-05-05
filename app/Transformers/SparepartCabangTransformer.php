<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\SparepartCabang;

class SparepartCabangTransformer extends TransformerAbstract
{
    /**
     * Transform Barang.
     *
     * @param Service $service
     */
    public function transform(SparepartCabang $sparepartCabang)
    {
        return [
            'id_sparepartCabang' => $sparepartCabang->id_sparepartCabang,
            'id_cabang_fk' => $sparepartCabang->id_cabang_fk,
<<<<<<< HEAD
            // 'nama_cabang'   => $sparepartCabang->cabang->nama_cabang, //ini ada sinta edit
=======
            // 'nama_cabang'   => $sparepartCabang->cabangs->nama_cabang, //ini ada sinta edit
>>>>>>> 25cc9106987ca0932c48f3884aa9c84bfc277c59
            'kode_sparepart_fk' => $sparepartCabang->kode_sparepart_fk,
            'hargaBeli_sparepart' => $sparepartCabang->hargaBeli_sparepart,
            'hargaJual_sparepart' => $sparepartCabang->hargaJual_sparepart,
            'letak_sparepart' => $sparepartCabang->letak_sparepart,
            'stokMin_sparepart' => $sparepartCabang->stokMin_sparepart,
            'stokSisa_sparepart' => $sparepartCabang->stokSisa_sparepart,
            
        ];
    }
}