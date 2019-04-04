<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\PengadaanSparepart;

class PengadaanSparepartTransformer extends TransformerAbstract
{
    /**
     * Transform Barang.
     *
     * @param Service $service
     */
    public function transform(PengadaanSparepart $pengadaanSparepart)
    {
        return [
            'id_pengadaan' => $pengadaanSparepart->id_pengadaan,
            'id_supplier_fk' => $pengadaanSparepart->id_supplier_fk,
            'id_sparepartCabang_fk' => $pengadaanSparepart->id_sparepartCabang_fk,
            'status_pengadaan' => $pengadaanSparepart->status_pengadaan,
            'satuan_pengadaan' => $pengadaanSparepart->satuan_pengadaan,
            'totalHarga_pengadaan' => $pengadaanSparepart->totalHarga_pengadaan,
            'totalBarang_datang' => $pengadaanSparepart->totalBarang_datang,
            'tgl_pengadaan' => $pengadaanSparepart->tgl_pengadaan,
            'tgl_barangDatang' => $pengadaanSparepart->tgl_barangDatang,
            'statusCetak_pengadaan' => $pengadaanSparepart->statusCetak_pengadaan,
        ];
    }
}