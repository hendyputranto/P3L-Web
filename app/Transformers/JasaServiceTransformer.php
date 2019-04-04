<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\JasaService;
class JasaServiceTransformer extends TransformerAbstract
{
    /**
     * Transform Barang.
     *
     * @param Service $service
     */
    public function transform(JasaService $jasaService)
    {
        return [
            'id_jasaService' => $jasaService->id_jasaService,
            'nama_jasaService' => $jasaService->nama_jasaService,
            'harga_jasaService' => $jasaService->harga_jasaService,
        ];
    }
}