<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Role
Route::get('role','RoleController@show');
Route::post('role','RoleController@create');
Route::put('role/{id}','RoleController@update');
Route::delete('role/{id}','RoleController@delete');

//Cabang
Route::get('cabang','CabangController@show');
Route::get('cabang/{id}','CabangController@showById');
Route::post('cabang','CabangController@create');
Route::put('cabang/{id}','CabangController@update');
Route::delete('cabang/{id}','CabangController@delete');

//Jasa Service
Route::get('jasaService','JasaServiceController@show');
Route::get('jasaService/{id}','JasaServiceController@showById');
Route::post('jasaService','JasaServiceController@create');
Route::put('jasaService/{id}','JasaServiceController@update');
Route::delete('jasaService/{id}','JasaServiceController@delete');

//Pegawai
Route::get('pegawai','PegawaiController@show');
Route::get('pegawai/{id}','PegawaiController@showById');
Route::post('pegawai','PegawaiController@create');
Route::put('pegawai/{id}','PegawaiController@update');
Route::delete('pegawai/{id}','PegawaiController@delete');

//Supplier
Route::get('supplier','SupplierController@show');
Route::get('supplier/{id}','SupplierController@showById');
Route::post('supplier','SupplierController@create');
Route::put('supplier/{id}','SupplierController@update');
Route::delete('supplier/{id}','SupplierController@delete');

//Spareart
Route::get('sparepart','SparepartController@show');
Route::get('sparepart/{kode}','SparepartController@showById');
Route::post('sparepart','SparepartController@create');
Route::put('sparepart/{kode}','SparepartController@update');
Route::delete('sparepart/{kode}','SparepartController@delete');

//Sparepart Cabang
Route::get('sparepartCabang','SparepartCabangController@show');
Route::get('sparepartCabang/{id}','SparepartCabangController@showById');
Route::post('sparepartCabang','SparepartCabangController@create');
Route::put('sparepartCabang/{id}','SparepartCabangController@update');
Route::delete('sparepartCabang/{id}','SparepartCabangController@delete');

//Pengadaan Sparepart
Route::get('pengadaanSparepart','PengadaanSparepartController@show');
Route::get('pengadaanSparepart/{id}','PengadaanSparepartController@showById');
Route::post('pengadaanSparepart','PengadaanSparepartController@create');
Route::put('pengadaanSparepart/{id}','PengadaanSparepartController@update');
Route::delete('pengadaanSparepart/{id}','PengadaanSparepartController@delete');
