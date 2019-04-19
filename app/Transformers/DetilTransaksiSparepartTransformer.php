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
            'id_detilTransaksiSparepart' => $dt_service->id_detilTransaksiSparepart,
            'id_transaksi_fk' => $dt_service->id_transaksi_fk,
            'id_sparepartCabang_fk' => $dt_service->id_sparepartCabang_fk,
            'id_motorKonsumen_fk' => $dt_service->id_motorKonsumen_fk,
            'jumlahBeli_sparepart' => $dt_service->jumlahBeli_sparepart,
            'subTotal_sparepart' => $dt_service->subTotal_sparepart,
            
            
        ];
    }
}