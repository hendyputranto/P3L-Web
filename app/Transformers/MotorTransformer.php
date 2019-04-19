<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Motor;
class MotorTransformer extends TransformerAbstract
{
    /**
     * Transform Barang.
     *
     * @param Service $service
     */
    public function transform(Motor $motor)
    {
        return [
            'id_motor' => $motor->id_motor,
            'kode_sparepart_fk' => $motor->kode_sparepart_fk,
            'merk_motor' => $motor->merk_motor,
            'tipe_motor' => $motor->tipe_motor,
        ];
    }
}