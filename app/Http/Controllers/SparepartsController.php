<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Sparepart;
use PhpParser\Node\Expr\BinaryOp\Spaceship;
use PHPUnit\Framework\Constraint\Exception;
use Illuminate\Support\Facades\DB;

class SparepartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getTipe() {
        $sparepart = Sparepart::distinct()->get(['tipe_sparepart']);
        return response()->json($sparepart, 200);
    }

    function tampilstokkurang() {
        $sparepart = DB::select('select kode_sparepart, nama_sparepart, merk_sparepart, tipe_sparepart, 
        gambar_sparepart, stokMin_sparepart, stokSisa_sparepart, hargaBeli_sparepart from spareparts join sparepart_cabangs ON spareparts.kode_sparepart=sparepart_cabangs.kode_sparepart_fk');
        return response()->json($sparepart, 200);
    }
}
