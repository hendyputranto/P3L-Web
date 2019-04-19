<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Detil_TransaksiService;
class DetilTransaksiServiceTransformer extends TransformerAbstract
{
    /**
     * Transform Barang.
     *
     * @param Service $service
     */
    public function transform(Detil_TransaksiService $dt_service)
    {
        return [
            'id_detilTransaksiService' => $dt_service->id_detilTransaksiService,
            'id_transaksi_fk' => $dt_service->id_transaksi_fk,
            'id_jasaService_fk' => $dt_service->id_jasaService_fk,
            'id_motorKonsumen_fk' => $dt_service->id_motorKonsumen_fk,
            'subTotal_service' => $dt_service->subTotal_service,
            'status_service' => $dt_service->status_service,
            
            
        ];
    }
}