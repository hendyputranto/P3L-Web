<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai_OnDuty;
use App\TransaksiPenjualan;
use App\Pegawai;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Transformers\PegawaiOnDutyTransformer;


class PegawaiOnDutyController extends RestController
{
    protected $transformer = PegawaiOnDutyTransformer::class;

    ////menampilkan data
    public function show(){
        $pegawaionduty = Pegawai_OnDuty::all();
        $response = $this->generateCollection($pegawaionduty);
        return $this->sendResponse($response);
    }
}
