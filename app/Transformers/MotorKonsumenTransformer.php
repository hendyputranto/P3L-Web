<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\MotorKonsumen;
class MotorKonsumenTransformer extends TransformerAbstract
{
    /**
     * Transform Barang.
     *
     * @param Service $service
     */
    public function transform(MotorKonsumen $motorKonsumen)
    {
        return [
            'id_motor_fk' => $motorKonsumen->id_motor_fk,
            'tipe_motor' => $motorKonsumen->motor->tipe_motor,
            'nama_konsumen' => $motorKonsumen->konsumen->nama_konsumen,
            'id_konsumen_fk' => $motorKonsumen->id_konsumen_fk,
            'id_motorKonsumen' => $motorKonsumen->id_motorKonsumen,
            'plat_motorKonsumen' => $motorKonsumen->plat_motorKonsumen,
            
        ];
    }
}