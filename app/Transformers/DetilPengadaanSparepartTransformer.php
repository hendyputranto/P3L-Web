<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\DetilPengadaanSparepart;

class DetilPengadaanSparepartTransformer extends TransformerAbstract
{
    /**
     * Transform Barang.
     *
     * @param Service $service
     */
    public function transform(DetilPengadaanSparepart $dps)
    {
        return [
            'id_detilPengadaanSparepart' => $dps->id_detilPengadaanSparepart,
            'id_pengadaan_fk' => $dps->id_pengadaan_fk,
            'id_sparepartCabang_fk' => $dps->id_sparepartCabang_fk,
            'kode_sparepart_fk' => $dps->sparepart_cabang->kode_sparepart_fk,
            'nama_sparepart' => $dps->sparepart_cabang->sparepart->nama_sparepart,
            'hargaBeli_sparepart' => $dps->sparepart_cabang->hargaBeli_sparepart,
            'satuan_pengadaan' => $dps->satuan_pengadaan,
            'sub_total_sparepart' => $dps->sub_total_sparepart,
            'totalBarang_datang' => $dps->totalBarang_datang,
        ];
    }
}