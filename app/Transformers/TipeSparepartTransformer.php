<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\SparepartCabang;

class TipeSparepartTransformer extends TransformerAbstract
{
    /**
     * Transform Barang.
     *
     * @param Service $service
     */

     
    public function transform(SparepartCabang $sparepart)
    {
        //ini ubah
        return [
            // 'tipe_sparepart' => $sparepart->sparepart->tipe_sparepart,
            // 'nama_sparepart' => $sparepart->sparepart->nama_sparepart,
            
        ];
    }
}