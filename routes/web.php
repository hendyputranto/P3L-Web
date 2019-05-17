<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('laporan','ReportController@LaporanPengeluaranBulanan');
Route::get('laporanpenjualanjasa','ReportController@LaporanPenjualanJasa');

// Route::get('laporan_tcp', function () {
//     return view('page.laporan_penjualan_jasa');
// });
Route::get('/', function () {
    return view('page.home');
});
Route::get('/pengadaan', function () {
    return view('page.pengadaanSparepart');
});
Route::get('/tPengadaan', function () {
    return view('page.tPengadaanSparepart');
});
Route::get('/ePengadaan', function () {
    return view('page.ePengadaanSparepart');
});
Route::get('/tkonsumen', function () {
    return view('page.tambahKonsumen');
});
Route::get('/ukonsumen', function () {
    return view('page.ubahKonsumen');
});
Route::get('/konsumen', function () {
    return view('page.konsumen');
});
Route::group(['prefix'=>'keloladata'],function(){

    Route::get('/dcabang', function () {
        
        return view('page.cabang');

    })->name('dcabang');

    Route::get('/dpegawai', function () {
        
        return view('page.pegawai');

    })->name('dpegawai');

    Route::get('/dsupplier', function () {
        
        return view('page.supplier');

    })->name('dsupplier');

    Route::get('/dsparepart', function () {
        
        return view('page.sparepart');

    })->name('dsparepart');

    Route::get('/djasaService', function () {
        
        return view('page.jasaservice');

    })->name('djasaService');

});

Route::get('/tcabang', function () {
    return view('page.tambahcabang');
});

Route::get('/ucabang', function () {
    return view('page.ubahcabang');
});

Route::get('/tpegawai', function () {
    return view('page.tambahpegawai');
});

Route::get('/upegawai', function () {
    return view('page.ubahpegawai');
});

Route::get('/tjasaservice', function () {
    return view('page.tambahjasaservice');
});

Route::get('/ujasaservice', function () {
    return view('page.ubahjasaservice');
});

Route::get('/tsupplier', function () {
    return view('page.tambahsupplier');
});

Route::get('/usupplier', function () {
    return view('page.ubahsupplier');
});

Route::get('/tsparepart', function () {
    return view('page.tambahsparepart');
});

Route::get('/usparepart', function () {
    return view('page.ubahsparepart');
});

Route::get('/transaksiSV', function () {
    return view('page.transaksiPenjualan');
});

Route::get('/transaksiSP', function () {
    return view('page.transaksiPenjualanSparepart');
});

Route::get('/ttransaksi', function () {
    return view('page.tampilTransaksi');
});

Route::get('/ttransaksis', function () {
    return view('page.tampilTransaksi1');
});

Route::get('/catalog', function () {
    return view('page.catalog');
});

Route::get('/homeKonsumen', function () {
    return view('page.homeKonsumen');
});

Route::get('laporan/pendapatan', function() {

    return view('pendapatanpertahun');
});

Route::get('laporan/pengeluaran', 'ReportController@LaporanPengeluaranBulanan');

//Route::resource('Konsumen','KonsumenController');