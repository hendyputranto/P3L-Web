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
            //'nama_cabang'   => $sparepartCabang->cabangs->nama_cabang, //ini ada sinta edit
=======
            'nama_cabang'   => $sparepartCabang->cabang->nama_cabang,
>>>>>>> 7c842180aea758e1343567b6a35bd8dc63b214ce
            'kode_sparepart_fk' => $sparepartCabang->kode_sparepart_fk,
            'nama_sparepart' => $sparepartCabang->sparepart->nama_sparepart,
            'hargaBeli_sparepart' => $sparepartCabang->hargaBeli_sparepart,
            'hargaJual_sparepart' => $sparepartCabang->hargaJual_sparepart,
            'letak_sparepart' => $sparepartCabang->letak_sparepart,
            'stokMin_sparepart' => $sparepartCabang->stokMin_sparepart,
            'stokSisa_sparepart' => $sparepartCabang->stokSisa_sparepart,
            
        ];
    }
}