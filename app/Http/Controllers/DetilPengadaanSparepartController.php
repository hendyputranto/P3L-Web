<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetilPengadaanSparepart;
use App\Transformers\DetilPengadaanSparepartTransformer;

class DetilPengadaanSparepartController extends RestController
{
    //
    protected $transformers = DetilPengadaanSparepartTransformer::class;

    public function index()
    {
        $detil = DetilPengadaanSparepart::get();
        $response = $this->generateCollection($detil);
        return $this->sendResponse($response);
    }

}
