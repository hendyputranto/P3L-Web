<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Motor;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Transformers\MotorTransformer;

class MotorController extends RestController
{
    protected $transformer = MotorTransformer::class;

    ////menampilkan data
    public function show(){
        $motor = Motor::all();
        $response = $this->generateCollection($motor);
        return $this->sendResponse($response);
    }

    //tampil by id
    public function showById(request $request, $id_motor){
        $motor = Motor::find($id_motor);
        $response = $this->generateItem($motor);
        return $this->sendResponse($response);
    }
    //nambah data
    public function create(request $request){
        
        $this->validate($request,[
            'kode_sparepart_fk' => 'required',
            'merk_motor' => 'required',
            'tipe_motor' => 'required',
        ]);   
        try{
            $motor = new Motor;
            $motor->kode_sparepart_fk = $request->kode_sparepart_fk;
            $motor->merk_motor = $request->merk_motor;
            $motor->tipe_motor = $request->tipe_motor;

            $motor->save();
            
            $response = $this->generateItem($motor);

            return $this->sendResponse($response,201);
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
        
    }
    //update data
    public function update(request $request, $id_motor){
        $kode_sparepart_fk = $request->kode_sparepart_fk;
        $merk_motor = $request->merk_motor;
        $tipe_motor = $request->tipe_motor;

        try{
            $motor = Motor::find($id_motor);
            $motor->kode_sparepart_fk = $kode_sparepart_fk;
            $motor->merk_motor = $merk_motor;
            $motor->tipe_motor = $tipe_motor;
            
            $motor->save();

            $response = $this->generateItem($motor);

            return $this->sendResponse($response,201);
        }catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('motor_not_found');
        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
        
    }

    //hapus data
    public function delete($id_motor){
        try{
        $motor = Motor::find($id_motor);
        $motor->delete();

            return response()->json('Successs', 201);
        }catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('motor_tidak_ditemukan');
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
    }
}
