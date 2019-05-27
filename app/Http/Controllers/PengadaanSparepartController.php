<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PengadaanSparepart;
use App\SparepartCabang;
use App\DetilPengadaanSparepart;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Transformers\PengadaanSparepartTransformer;
//use App\Transformers\DetilPengadaanSparepartTransformer;

class PengadaanSparepartController extends RestController
{
    protected $transformer = PengadaanSparepartTransformer::class;
     
    //menampilkan data
     public function show(){
        $pengadaanSparepart = PengadaanSparepart::all();
        $response = $this->generateCollection($pengadaanSparepart);
        return $this->sendResponse($response);
    }

    //tampil by id
    public function showById(request $request, $id_pengadaan){
        $pengadaanSparepart = PengadaanSparepart::find($id_pengadaan);
        $response = $this->generateItem($pengadaanSparepart);
        return $this->sendResponse($response);
    }
    //nambah data
    public function createPengadaanSparepart(Request $request){
        try{
            date_default_timezone_set('Asia/Jakarta');
            $pengadaanSparepart = new PengadaanSparepart;
            if($request->has('detil'))
            {
                $detil = $request->detil;
            }
            $pengadaanSparepart->statusCetak_pengadaan = "Belum Cetak";
            $pengadaanSparepart->status_pengadaan = "Belum Selesai";
            $pengadaanSparepart->tgl_pengadaan = date("Y-m-d").' '.date('H:i:s');
            $pengadaanSparepart->tgl_barangDatang = null;
      
            $pengadaanSparepart->id_supplier_fk = $request->id_supplier_fk;
            $pengadaanSparepart->id_cabang_fk = $request->id_cabang_fk;
            $pengadaanSparepart->totalHarga_pengadaan = $request->totalHarga_pengadaan;
           
            $pengadaanSparepart->save();

            if($request->has('detil'))
            {
                $pengadaanSparepart = DB::transaction(function()use($pengadaanSparepart,$detil){
                    $pengadaanSparepart->detil_pengadaansparepart()->createMany($detil);
                    return $pengadaanSparepart;
                    //input data dalam bentuk array 2d, meskipun datanya cuma 1. 
                });
            }
            $response = $this->generateItem($pengadaanSparepart);

            return $this->sendResponse($response, 201);
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
    }
   //hendy 
   public function create(request $request)
    {
        try {
            date_default_timezone_set('Asia/Jakarta');
            $pengadaanSparepart = new PengadaanSparepart;
            
            $id = array();

            
            $pengadaanSparepart->statusCetak_pengadaan = "Belum Cetak";
            $pengadaanSparepart->status_pengadaan = "Belum Selesai";
            $pengadaanSparepart->tgl_pengadaan = date("Y-m-d").' '.date('H:i:s');
            $pengadaanSparepart->tgl_barangDatang = null;
      
            $pengadaanSparepart->id_supplier_fk = $request->id_supplier_fk;
            $pengadaanSparepart->id_cabang_fk = $request->id_cabang_fk;
            $pengadaanSparepart->totalHarga_pengadaan = $request->totalHarga_pengadaan;
            
            $pengadaanSparepart->save();

            
            $response = $this->generateItem($pengadaanSparepart);
            return $this->sendResponse($response, 201);
        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }


    //update sinta
    public function verifikasi_pengadaan($id)
    {
        try
        {
            date_default_timezone_set('Asia/Jakarta');
            $pengadaanSparepart = PengadaanSparepart::find($id);
            $pengadaanSparepart->status_pengadaan ='Sudah Selesai';

            $pengadaanSparepart->tgl_barangDatang=date("Y-m-d").' '.date('H:i:s');
            $detil=DetilPengadaanSparepart::where('id_pengadaan_fk',$id)->get();
            $countdetil = count($detil);
            for($i=0;$i<$countdetil;$i++)
            {
                $detil[$i]->totalBarang_datang = $detil[$i]->satuan_pengadaan;
                $sparepart=SparepartCabang::find($detil[$i]->id_sparepartCabang_fk);
                $sparepart->stokSisa_sparepart+=$detil[$i]->totalBarang_datang;
                $detil[$i]->save();    
                $sparepart->save();
            }
            
            $pengadaanSparepart->save();
            $response = $this->generateItem($pengadaanSparepart);
            return $this->sendResponse($response, 201);
        }
        catch (\Exception $e)
        {
            return $this->sendIseResponse($e->getMessage());
        }
    }
    public function update_mobile(Request $request, $id)
    {
        try
        {
            $pengadaanSparepart = PengadaanSparepart::find($id);
            if(!is_null($request->id_supplier_fk))
            {
                $pengadaanSparepart->id_supplier_fk = $request->id_supplier_fk;
            }
            if(!is_null($request->id_cabang_fk))
            {
                $pengadaanSparepart->id_cabang_fk = $request->id_cabang_fk;
            }
            if(!is_null($request->totalHarga_pengadaan))
            {
                $pengadaanSparepart->totalHarga_pengadaan = $request->totalHarga_pengadaan;
            }
            
            $detilPengadaans = DetilPengadaanSparepart::where('id_pengadaan_fk',$id)->get();
            foreach($detilPengadaans as $detilPengadaan)
            {  
                $delDetilPengadaan = $detilPengadaan->delete();
            }

            if($request->has('detil_pengadaan'))
            {
                $detil = $request->detil_pengadaan;
                $pengadaanSparepart = DB::transaction(function()use($pengadaanSparepart,$detil){
                $pengadaanSparepart->detil_pengadaansparepart()->createMany($detil);
                return $pengadaanSparepart;
                });
            }
            $pengadaanSparepart->save();
            $response = $this->generateItem($pengadaanSparepart);
            return $this->sendResponse($response, 201);
        }
        catch (\Exception $e)
        {
            return $this->sendIseResponse($e->getMessage());
        }
    }
    //update data
    public function update(request $request, $id_pengadaan){
        $id_supplier_fk = $request->id_supplier_fk;
        $id_sparepartCabang_fk = $request->id_sparepartCabang_fk;
        $status_pengadaan = $request->status_pengadaan;
        $satuan_pengadaan = $request->satuan_pengadaan;
        $totalHarga_pengadaan = $request->totalHarga_pengadaan;
        $totalBarang_datang = $request->totalBarang_datang;
       // $tgl_pengadaan = $request->tgl_pengadaan;
        $tgl_barangDatang = $request->tgl_barangDatang;
        $statusCetak_pengadaan = $request->statusCetak_pengadaan;

        try{
            $pengadaanSparepart = PengadaanSparepart::find($id_pengadaan);
            $pengadaanSparepart->id_supplier_fk = $id_supplier_fk;
            $pengadaanSparepart->id_sparepartCabang_fk = $id_sparepartCabang_fk;
            $pengadaanSparepart->status_pengadaan = $status_pengadaan;
            $pengadaanSparepart->satuan_pengadaan = $satuan_pengadaan;
            $pengadaanSparepart->totalHarga_pengadaan = $totalHarga_pengadaan;
            $pengadaanSparepart->totalBarang_datang = $totalBarang_datang;
            //$pengadaanSparepart->tgl_pengadaan = $tgl_pengadaan;
            $pengadaanSparepart->tgl_barangDatang = $tgl_barangDatang;
            $pengadaanSparepart->statusCetak_pengadaan = $statusCetak_pengadaan;
            
            $pengadaanSparepart->save();

            $response = $this->generateItem($pengadaanSparepart);

            return $this->sendResponse($response, 201);
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('pengadaan_tidak_ditemukan');
        }
        
    }

    //hapus data
    public function delete($id_pengadaan){
        try {
            $detilPengadaanSpareparts = DetilPengadaanSparepart::where('id_pengadaan_fk',$id_pengadaan)->get();
            foreach($detilPengadaanSpareparts as $detilPengadaanSparepart)
            {  
                $delDetilPengadaan = $detilPengadaanSparepart->delete();
            }
            $pengadaanSparepart=PengadaanSparepart::find($id_pengadaan);
            $pengadaanSparepart->delete();

            return response()->json('Success',200);
        } catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('pengadaan_not_found');
        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }
}
