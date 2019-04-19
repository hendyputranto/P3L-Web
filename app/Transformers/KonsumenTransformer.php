<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Konsumen;
class KonsumenTransformer extends TransformerAbstract
{
    /**
     * Transform Barang.
     *
     * @param Service $service
     */
    public function transform(Konsumen $konsumen)
    {
        return [
            'id_konsumen' => $konsumen->id_konsumen,
            'nama_konsumen' => $konsumen->nama_konsumen,
            'noTelp_konsumen' => $konsumen->noTelp_konsumen,
            'alamat_konsumen' => $konsumen->alamat_konsumen,
        ];
    }
}