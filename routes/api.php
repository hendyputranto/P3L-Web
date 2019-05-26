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
Route::get('jasaService/sortByHargaAsc','JasaServiceController@sortByHargaAsc');
Route::get('jasaService','JasaServiceController@show');
Route::get('jasaService/{id}','JasaServiceController@showById');
Route::post('jasaService','JasaServiceController@create');
Route::put('jasaService/{id}','JasaServiceController@update');
Route::delete('jasaService/{id}','JasaServiceController@delete');

//Konsumen
Route::get('konsumen','KonsumenController@show');
Route::get('konsumen/{id}','KonsumenController@showById');
Route::get('konsumen/showByName/{nama_konsumen}','KonsumenController@showByName');
Route::post('konsumen','KonsumenController@create');
Route::put('konsumen/{id}','KonsumenController@update');
Route::delete('konsumen/{id}','KonsumenController@delete');

//Motor
Route::get('motor','MotorController@show');
Route::get('motor/{id}','MotorController@showById');
Route::post('motor','MotorController@create');
Route::put('motor/{id}','MotorController@update');
Route::delete('motor/{id}','MotorController@delete');

//Motor Konsumen
Route::get('motorKonsumen','MotorKonsumenController@show');
Route::get('motorKonsumen/{id}','MotorKonsumenController@showById');
Route::post('motorKonsumen','MotorKonsumenController@create');
Route::put('motorKonsumen/{id}','MotorKonsumenController@update');
Route::delete('motorKonsumen/{id}','MotorKonsumenController@delete');

//Pegawai
Route::get('pegawai','PegawaiController@show');
Route::get('pegawai/{id}','PegawaiController@showById');
Route::post('pegawai','PegawaiController@create');
Route::put('pegawai/{id}','PegawaiController@update');
Route::delete('pegawai/{id}','PegawaiController@delete');
Route::POST('/pegawai/mobileauthenticate','PegawaiController@mobileauthenticate');

//Pegawai On Duty
Route::get('pegawaionduty','PegawaiOnDutyController@show');
//Supplier
Route::get('supplier','SupplierController@show');
Route::get('supplier/{id}','SupplierController@showById');
Route::post('supplier','SupplierController@create');
Route::put('supplier/{id}','SupplierController@update');
Route::delete('supplier/{id}','SupplierController@delete');

//Sparepart
Route::get('sparepart','SparepartController@show');
Route::get('sparepart/{kode}','SparepartController@showById');
Route::post('sparepart/store','SparepartController@create');
Route::post('sparepart/{kode}','SparepartController@update');
Route::post('sparepart/updateImageMobile/{kode}','SparepartController@updateImageMobile');
Route::delete('sparepart/{kode}','SparepartController@delete');

//Sparepart Cabang
Route::post('sparepartCabang','SparepartCabangController@create');
Route::get('sparepartCabang','SparepartCabangController@show');
Route::get('sparepartCabang/{id}','SparepartCabangController@showById');
Route::put('sparepartCabang/{id}','SparepartCabangController@update');
Route::delete('sparepartCabang/{id}','SparepartCabangController@delete');

Route::get('sparepartCabang/stokKurang','SparepartCabangController@showStokKurang'); //gabisa
Route::get('sparepartCabang/stokKurangByCabang/{id}','SparepartCabangController@showStokKurangByCabang');
Route::get('sparepartCabang/showByCabang/{id}','SparepartCabangController@showByCabang');
Route::get('sparepartCabang/showByTipe/{id}','SparepartCabangController@showByTipeSparepart');
 
Route::get('sparepartCabang/sortByStokSisaAsc/{id}','SparepartCabangController@sortByStokSisaAsc');
Route::get('sparepartCabang/sortByStokSisaDesc/{id}','SparepartCabangController@sortByStokSisaDesc');
Route::get('sparepartCabang/sortByHargaAsc/{id}','SparepartCabangController@sortByHargaAsc');
Route::get('sparepartCabang/sortByHargaDesc/{id}','SparepartCabangController@sortByHargaDesc');
Route::get('sparepartCabang/sort','SparepartCabangController@testsort');

//Pengadaan Sparepart
Route::get('pengadaanSparepart','PengadaanSparepartController@show');
Route::get('pengadaanSparepart/{id}','PengadaanSparepartController@showById');
Route::post('pengadaanSparepart/createPengadaanSparepart','PengadaanSparepartController@createPengadaanSparepart');
Route::put('pengadaanSparepart/{id}','PengadaanSparepartController@update_mobile');
Route::put('pengadaanSparepart/verifikasi_pengadaan/{id}','PengadaanSparepartController@verifikasi_pengadaan');
Route::delete('pengadaanSparepart/{id}','PengadaanSparepartController@delete');

//Detil Pengadaan Sparepart
Route::get('detilPengadaanSparepart','DetilPengadaanSparepartController@show');
Route::get('detilPengadaanSparepart/showByIdPengadaan/{id}','DetilPengadaanSparepartController@showByIdPengadaan');
Route::post('detilPengadaanSparepart/createDetilPengadaan','DetilPengadaanSparepartController@createDetilPengadaan');



//Transaksi Penjualan
Route::get('transaksiPenjualan','TransaksiPenjualanController@show');
Route::get('transaksiPenjualan/{id}','TransaksiPenjualanController@showById');
Route::get('transaksiPenjualan/showLunas','TransaksiPenjualanController@showSudahLunas');
Route::post('transaksiPenjualanSV','TransaksiPenjualanController@createSV');
Route::post('transaksiPenjualanSP','TransaksiPenjualanController@createSP');
Route::post('transaksiPenjualanSS','TransaksiPenjualanController@createSS');
Route::put('transaksiPenjualan/{id}','TransaksiPenjualanController@update');
Route::post('transaksiPenjualanSparepart','TransaksiPenjualanController@createTransaksiPenjualan_sinta');
Route::put('transaksiPenjualan/update_sinta/{id}','TransaksiPenjualanController@update_sinta');
Route::put('transaksiPenjualan/update_status_transaksi_sinta/{id}','TransaksiPenjualanController@update_status_transaksi_sinta');
Route::delete('deleteTransaksiPenjualan/{id}','TransaksiPenjualanController@deleteTransaksiPenjualan');

Route::put('transaksiPenjualan/payment/{id}','TransaksiPenjualanController@payment');
Route::delete('transaksiPenjualan/{id}','TransaksiPenjualanController@delete');

Route::get('transaksiPenjualan/showByPlatKonsumen{id}','TransaksiPenjualanController@showByPlatKonsumen');

//Detil Transaksi Service
Route::get('detilJasa','DetilTransaksiServiceController@show');
Route::get('detilJasa/{id}','DetilTransaksiServiceController@showById');
Route::get('detilJasa/showSelesai','DetilTransaksiServiceController@showByStatus');
Route::post('detilJasa','DetilTransaksiServiceController@create');
//Route::put('detilJasa/{id}','DetilTransaksiServiceController@update')
Route::delete('detilJasa/{id}','DetilTransaksiServiceController@delete');
Route::post('createDetilTransaksiService','DetilTransaksiServiceController@createDetilTransaksiService');
//Detil Transaksi Sparepart
Route::get('detilSparepart','DetilTransaksiSparepartController@show');
Route::get('detilSparepart/{id}','DetilTransaksiSparepartController@showById');
Route::get('detilSparepart/transaksi/{id}','DetilTransaksiSparepartController@showByIdTransaksi');
Route::post('detilSparepart','DetilTransaksiSparepartController@create');
//sinta
Route::post('createDetilTransaksiSparepart','DetilTransaksiSparepartController@createDetilTransaksiSparepart');

//Route::put('detilSparepart/{id}','DetilTransaksiSparepartController@update');
Route::delete('detilSparepart/{id}','DetilTransaksiSparepartController@delete');
//report
Route::get('spkDesktop/{id}','ReportController@cetakSuratPerintahKerjaDesktop');
Route::get('suratPemesananDesktop/{id}','ReportController@cetakSuratPemesananDesktop');
Route::get('notaPembayaranDesktop/{id}','ReportController@cetakNotaPembayaranDesktop');
Route::get('sparepartTerlaris','ReportController@sparepartTerlaris');
Route::get('pendapatanBulanan','ReportController@pendapatanBulanan');