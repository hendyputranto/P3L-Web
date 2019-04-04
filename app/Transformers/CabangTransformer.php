<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Cabang;

class CabangTransformer extends TransformerAbstract
{
    /**
     * Transform Branch.
     *
     * @param Branch $branch
     */
    public function transform(Cabang $cabang)
    {
        return [
            'id_cabang'                    => $cabang->id_cabang,
            'nama_cabang'            => $cabang->nama_cabang,
            'alamat_cabang'         => $cabang->alamat_cabang,
            'noTelp_cabang'        => $cabang->noTelp_cabang,
        ];
    }
}