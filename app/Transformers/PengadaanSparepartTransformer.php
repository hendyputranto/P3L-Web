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

     protected $defaultIncludes = [
         'detil_PengadaanSparepart' 
     ];
    public function transform(PengadaanSparepart $pengadaanSparepart)
    {
        //ini ubah
        return [
            'id_pengadaan' => $pengadaanSparepart->id_pengadaan,
            'id_supplier_fk' => $pengadaanSparepart->id_supplier_fk,
            'id_cabang_fk' =>  $pengadaanSparepart->cabang->id_cabang,
            'nama_supplier'  => $pengadaanSparepart->supplier->nama_supplier,
            'nama_cabang' => $pengadaanSparepart->cabang->nama_cabang,
            'status_pengadaan' => $pengadaanSparepart->status_pengadaan,
            'totalHarga_pengadaan' => $pengadaanSparepart->totalHarga_pengadaan,
            'tgl_pengadaan' => $pengadaanSparepart->tgl_pengadaan,
            'tgl_barangDatang' => $pengadaanSparepart->tgl_barangDatang,
            'statusCetak_pengadaan' => $pengadaanSparepart->statusCetak_pengadaan,
        ];
    }

    public function includeDetilPengadaanSparepart(PengadaanSparepart $pengadaanSparepart)
    {
        //collection itu seperti array
        return $this->collection($pengadaanSparepart->detil_pengadaansparepart, new DetilPengadaanSparepartTransformer);
    }
}