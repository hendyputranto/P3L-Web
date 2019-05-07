<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Detil_TransaksiSparepart;

class DetilTransaksiSparepartTransformer extends TransformerAbstract
{
    /**
     * Transform Barang.
     *
     * @param Service $service
     */
    public function transform(Detil_TransaksiSparepart $dt_sparepart)
    {
        return [
            'id_detilTransaksiSparepart' => $dt_sparepart->id_detilTransaksiSparepart,
            'id_transaksi_fk' => $dt_sparepart->id_transaksi_fk,
            'id_sparepartCabang_fk' => $dt_sparepart->id_sparepartCabang_fk,
            'id_konsumen_fk' => $dt_sparepart->id_konsumen_fk,
            'jumlahBeli_sparepart' => $dt_sparepart->jumlahBeli_sparepart,
            'subTotal_sparepart' => $dt_sparepart->subTotal_sparepart,
            
            
        ];
    }
}