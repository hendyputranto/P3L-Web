<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SparepartCabang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SparepartCabangController2 extends Controller
{

    public function sortByStokSisaAsc(){
        //$sparepartCabang = SparepartCabang::orderBy('stokSisa_sparepart')->where('id_cabang_fk',$id)->get();
        $sparepartCabang = SparepartCabang::orderBy('stokSisa_sparepart')->get();
        return response()->json([
            'data' => $sparepartCabang,
        ]);
        // $response = $this->generateCollection($sparepartCabang);
        // return $this->sendResponse($response,201);
    }
}
