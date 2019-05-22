<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MotorKonsumen;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Transformers\MotorKonsumenTransformer;

class MotorKonsumenController extends RestController
{
    protected $transformer = MotorKonsumenTransformer::class;

    ////menampilkan data
    public function show(){
        $motorKonsumen = MotorKonsumen::all();
        $response = $this->generateCollection($motorKonsumen);
        return $this->sendResponse($response);
    }
    //tampil by nama konsumen
    public function showByPlat($plat_motorKonsumen){
        $motorKonsumen = MotorKonsumen::where('plat_motorKonsumen',$plat_motorKonsumen)->first();
        $response = $this->generateItem($motorKonsumen);
        return $this->sendResponse($response,201);
    }
    //tampil by id
    public function showById(request $request, $id_motorKonsumen){
        $motorKonsumen = MotorKonsumen::find($id_motorKonsumen);
        $response = $this->generateItem($motorKonsumen);
        return $this->sendResponse($response);
    }
    //nambah data
    public function create(request $request){
        
        $this->validate($request,[
            'id_motor_fk' => 'required',
            'id_konsumen_fk' => 'required',
            'plat_motorKonsumen' => 'required',
        ]);   
        try{
            $motorKonsumen = new MotorKonsumen;
            $motorKonsumen->id_motor_fk = $request->id_motor_fk;
            $motorKonsumen->id_konsumen_fk = $request->id_konsumen_fk;
            $motorKonsumen->plat_motorKonsumen = $request->plat_motorKonsumen;

            $motorKonsumen->save();
            
            $response = $this->generateItem($motorKonsumen);

            return $this->sendResponse($response,201);
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
        
    }
    //update data
    public function update(request $request, $id_motorKonsumen){
        $id_motor_fk = $request->id_motor_fk;
        $id_konsumen_fk = $request->id_konsumen_fk;
        $plat_motorKonsumen = $request->plat_motorKonsumen;

        try{
            $motorKonsumen = MotorKonsumen::find($id_motorKonsumen);
            $motorKonsumen->id_motor_fk = $id_motor_fk;
            $motorKonsumen->id_konsumen_fk = $id_konsumen_fk;
            $motorKonsumen->plat_motorKonsumen = $plat_motorKonsumen;
            
            $motorKonsumen->save();

            $response = $this->generateItem($motorKonsumen);

            return $this->sendResponse($response,201);
        }catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('motorKonsumen_not_found');
        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
        
    }

    public function findDataKonsumen($id_motorKonsumen)
    {
        try{
            $FinalDataKonsumen = new Konsumen;
            
            $DataKonsumen = MotorKonsumen::find($id_motorKonsumen);
            $FinalDataKonsumen = Konsumen::find($DataKonsumen->id_konsumen_fk);
            $response = $this->generateItem($FinalDataKonsumen);
            
            return $this->sendResponse($response,201);
        }
        catch (ModelNotFoundException $e)
        {
                return $this->sendNotFoundResponse('motorKonsumen_not_found');
        }
        catch (\Exception $e)
        {
                return $this->sendIseResponse($e->getMessage());
        }
    }
    public function findDataMotor($id_motorKonsumen)
    {
        try{
            $FinalDataMotor = new Motor;
            
            $DataMotor = MotorKonsumen::find($id_motorKonsumen);
            $FinalDataMotor = Motor::find($DataKonsumen->id_motor_fk);
            $response = $this->generateItem($FinalDataMotor);
            
            return $this->sendResponse($response,201);
        }
        catch (ModelNotFoundException $e)
        {
                return $this->sendNotFoundResponse('motorKonsumen_not_found');
        }
        catch (\Exception $e)
        {
                return $this->sendIseResponse($e->getMessage());
        }
    }

    //hapus data
    public function delete($id_motorKonsumen){
        try{
        $motorKonsumen = MotorKonsumen::find($id_motorKonsumen);
        $motorKonsumen->delete();

            return response()->json('Successs', 201);
        }catch (ModelNotFoundException $e) {
            return $this->sendNotFoundResponse('motorKonsumen_tidak_ditemukan');
        }catch(\Exception $e){
            return $this->sendIseResponse($e->getMessage());
        }
    }
}
