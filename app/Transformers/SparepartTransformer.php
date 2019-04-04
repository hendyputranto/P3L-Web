<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Sparepart;

class SparepartTransformer extends TransformerAbstract
{
    /**
     * Transform Barang.
     *
     * @param Service $service
     */
    public function transform(Sparepart $sparepart)
    {
        return [
            'kode_sparepart' => $sparepart->kode_sparepart,
            'nama_sparepart' => $sparepart->nama_sparepart,
            'merk_sparepart' => $sparepart->merk_sparepart,
            'tipe_sparepart' => $sparepart->tipe_sparepart,
            'gambar_sparepart' => $sparepart->gambar_sparepart,
            
        ];
    }
}