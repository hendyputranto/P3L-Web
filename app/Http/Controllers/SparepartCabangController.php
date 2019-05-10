<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SparepartCabang;
use App\Sparepart;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Transformers\SparepartCabangTransformer;
use App\Transformers\TipeSparepartTransformer;

class SparepartCabangController extends RestController
{
    protected $transformer = SparepartCabangTransformer::class;
   //menampilkan data
     public function show(){
        $sparepartCabang = SparepartCabang::all();
        $response = $this->generateCollection($sparepartCabang);
        return $this->sendResponse($response);
    }
     public function showStokKurang(){
         try{
            if($sparepartCabang->stokSisa_sparepart < $sparepartCabang->stokMin_sparepart)
            {
                $sparepartCabang = SparepartCabang::all();
                $response = $this->generateCollection($sparepartCabang);
                return $this->sendResponse($response);
            }
         }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
         }
        
        
    }

    //tampil by id
    public function showById(request $request, $id_sparepartCabang){
        $sparepartCabang = SparepartCabang::find($id_sparepartCabang);
        $response = $this->generateItem($sparepartCabang);
        return $this->sendResponse($response);
    }

    public function showByCabang(request $request, $id)
    {
        $sparepart = SparepartCabang::where('id_cabang_fk',$id)->get();
        $response = $this->generateCollection($sparepart);
        return $this->sendResponse($response);
    }

    // public function showByTipeSparepart(request $request, $id_cabang)
    // {
    //     $sparepart_cabang = SparepartCabang::where('id_cabang_fk',$id_cabang)->get();

    //     $spareparts = $sparepart_cabang->map(function ($item) {
    //         return [
    //             'tipe_sparepart' => $item->sparepart->tipe_sparepart,
    //             'nama_sparepart' => $item->sparepart->nama_sparepart,
    //         ];
    //     });
    //     // $tipe = new TipeSparepartTransformer;
    //     // dd($spareparts);
    //     // $temp = $sparepart_cabang[0]->kode_sparepart_fk;
    //     // $tipe_sparepart = Sparepart::where('kode_sparepart',$temp)->get();
    //     $response = $this->generateCollection($spareparts);
    //     return $this->sendResponse($response);
    // }


    //nambah data
    public function create(request $request){
        $this->validate($request,[
            'id_cabang_fk' => 'required',
            'kode_sparepart_fk' => 'required',
            'hargaBeli_sparepart' => 'required',
            'hargaJual_sparepart' => 'required',
            'letak_sparepart' => 'required',
            'stokMin_sparepart' => 'required',
            'stokSisa_sparepart' => 'required',
        ]);
        
        try{
            $sparepartCabang = new SparepartCabang;
        
            $sparepartCabang->id_cabang_fk = $request->id_cabang_fk;
            $sparepartCabang->kode_sparepart_fk = $request->kode_sparepart_fk;
            $sparepartCabang->hargaBeli_sparepart = $request->hargaBeli_sparepart;
            $sparepartCabang->hargaJual_sparepart = $request->hargaJual_sparepart;
            $sparepartCabang->letak_sparepart = $request->letak_sparepart;
            $sparepartCabang->stokMin_sparepart = $request->stokMin_sparepart;
            $sparepartCabang->stokSisa_sparepart = $request->stokSisa_sparepart;
            
            $sparepartCabang->save();

            $response = $this->generateItem($sparepartCabang);

            return $this->sendResponse($response, 201);
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
        
    }
    //update data
    public function update(request $request, $id_sparepartCabang){
        $id_cabang_fk = $request->id_cabang_fk;
        $kode_sparepart_fk = $request->kode_sparepart_fk;
        $hargaBeli_sparepart = $request->hargaBeli_sparepart;
        $hargaJual_sparepart = $request->hargaJual_sparepart;
        $letak_sparepart = $request->letak_sparepart;
        $stokMin_sparepart = $request->stokMin_sparepart;
        $stokSisa_sparepart = $request->stokSisa_sparepart;

        try{
            $sparepartCabang = SparepartCabang::find($id_sparepartCabang);
            $sparepartCabang->id_cabang_fk = $id_cabang_fk;
            $sparepartCabang->kode_sparepart_fk = $kode_sparepart_fk;
            $sparepartCabang->hargaBeli_sparepart = $hargaBeli_sparepart;
            $sparepartCabang->hargaJual_sparepart = $hargaJual_sparepart;
            $sparepartCabang->letak_sparepart = $letak_sparepart;
            $sparepartCabang->stokMin_sparepart = $stokMin_sparepart;
            $sparepartCabang->stokSisa_sparepart = $stokSisa_sparepart;
            
            $sparepartCabang->save();

            $response = $this->generateItem($sparepartCabang);

            return $this->sendResponse($response, 201);
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('cabang_tidak_ditemukan');
        }
        
    }

    //hapus data
    public function delete($id_sparepartCabang){
       
        try{
            $sparepartCabang = SparepartCabang::find($id_sparepartCabang);
            $sparepartCabang->delete();
    
            return response()->json('Successs', 201);
        }catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('cabang_tidak_ditemukan');
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
       
    }
}
