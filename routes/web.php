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

Route::get('/login', function () {
    return view('master.login');
});

//bagian owner
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

    Route::get('/dmotor', function () {
        
        return view('page.motor');

    })->name('dmotor');

    Route::get('/dsparepartCabang', function () {
        
        return view('page.sparepartcabang');

    })->name('dsparepartCabang');

    Route::get('/dsisastoksparepart', function () {
        
        return view('page.sisastoksparepart');

    })->name('dsisastoksparepart');
    
});

Route::get('/cabang', function () {
    return view('page.cabang');
});
Route::get('/tcabang', function () {
    return view('page.tambahcabang');
});

Route::get('/ucabang', function () {
    return view('page.ubahcabang');
});

Route::get('/pegawai', function () {
    return view('page.pegawai');
});
Route::get('/tpegawai', function () {
    return view('page.tambahpegawai');
});

Route::get('/upegawai', function () {
    return view('page.ubahpegawai');
});

Route::get('/jasaservice', function () {
    return view('page.tambahjasaservice');
});
Route::get('/tjasaservice', function () {
    return view('page.tambahjasaservice');
});

Route::get('/ujasaservice', function () {
    return view('page.ubahjasaservice');
});

Route::get('/supplier', function () {
    return view('page.supplier');
});
Route::get('/tsupplier', function () {
    return view('page.tambahsupplier');
});

Route::get('/usupplier', function () {
    return view('page.ubahsupplier');
});

Route::get('/sparepart', function () {
    return view('page.tambahsparepart');
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
Route::get('/transaksiSS', function () {
    return view('page.transaksiPenjualanSS');
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
Route::get('laporan/penjualanJasa', function() {

    return view('laporanpenjualanjasa');
});
Route::get('laporan/pendapatanBulanan', function() {

    return view('laporanPendapatanBulanan');
});
Route::get('laporan/sparepartTerlaris', function() {

    return view('laporanSparepartTerlarisBulanan');
});
Route::get('cetakPemesanan', function() {

    return view('cetakSuratPemesanan');
});

Route::get('/nlaporansisastok', function () {
    return view('page.laporansisastok');
});

Route::get('/npendapatanpertahun', function () {
    return view('page.pendapatanpertahun');
});

Route::get('/nnotalunas', function () {
    return view('page.notalunas');
});

Route::get('/nlaporan', function () {
    return view('page.laporan');
});
Route::get('laporan/pengeluaran', 'ReportController@LaporanPengeluaranBulanan');

//bagian CS
Route::group(['prefix'=>'keloladataCS'],function(){

    Route::get('/dkonsumen', function () {
        
        return view('pageCS.konsumen');

    })->name('dkonsumen');

    Route::get('/dmotorkonsumen', function () {
        
        return view('pageCS.motorkonsumen');

    })->name('dmotorkonsumen');

    Route::get('/dtransaksiPenjualan', function () {
        
        return view('pageCS.transaksiPenjualan');

    })->name('dtransaksiPenjualan');

    Route::get('/dtampilTransaksi', function () {
        
        return view('pageCS.tampilTransaksi');

    })->name('dtampilTransaksi');

    Route::get('/dtransaksiPenjualanSparepart', function () {
        
        return view('pageCS.transaksiPenjualanSparepart');

    })->name('dtransaksiPenjualanSparepart');

    Route::get('/dtampilTransaksi1', function () {
        
        return view('pageCS.tampilTransaksi1');

    })->name('dtampilTransaksi1');
});

Route::get('/tkonsumen', function () {
    return view('pageCS.tambahKonsumen');
});
Route::get('/ukonsumen', function () {
    return view('pageCS.ubahKonsumen');
});

Route::get('/tmotorkonsumen', function () {
    return view('pageCS.tambahmotorkonsumen');
});

Route::get('/umotorkonsumen', function () {
    return view('pageCS.ubahmotorkonsumen');
});

Route::get('/utransaksiservice', function () {
    return view('pageCS.ubahtransaksiservice');
});

Route::get('/notaspk', function () {
    return view('pageCS.notaspk');
});

//bagian kosumen
Route::get('/homeKonsumen', function () {
    return view('pageKonsumen.homeKonsumen');
});

Route::get('/catalog', function () {
    return view('pageKonsumen.catalog');
});

Route::get('/transaksiPenjualan', function () {
    return view('pageKonsumen.transaksiPenjualan');
});

Route::get('/transaksiPenjualanSparepart', function () {
    return view('pageKonsumen.transaksiPenjualanSparepart');
});

Route::get('/riwayatKonsumen', function () {
    return view('pageKonsumen.riwayat');
});

Route::get('/cektransaksi', function () {
    return view('pageKonsumen.cektransaksi');
});
