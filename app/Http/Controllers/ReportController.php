<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PengadaanSparepart;
use DB;

class ReportController extends Controller
{
    public function LaporanPengeluaranBulanan()
    {
        $query = DB::table('pengadaan_spareparts')->select(DB::raw('EXTRACT(MONTH FROM tgl_pengadaan) AS Bulan, SUM(totalHarga_pengadaan) as Pengeluaran'))
        //->where('tanggalPemesanan', 'LIKE', '%'.$request->tahun.'%')
        ->groupBy(DB::raw('EXTRACT(MONTH FROM tgl_pengadaan)'))
        ->get();

        $count=count($query);
        //dd($count);
        $label  = [];
        $data   = [];
        $total=0;
        for($i=0;$i<$count;$i++)
        {
            $label[$i]  = $query[$i]->Bulan;
            $data[$i]   = $query[$i]->Pengeluaran;
            $total=($query[$i]->Pengeluaran)+$total;

        }
        return view('pengeluaranbulanan', ['query'=>$query, 'label'=>$label, 'data'=>$data, 'no'=>0, 'total'=>$total]);
    }
    public function cetakSuratPerintahKerjaDesktop($id)
    {
        $data1 = DB::select("SELECT t.id_transaksi as id_transaksi, s.kode_sparepart as Kode, s.nama_sparepart as Nama, s.merk_sparepart as Merk, sc.letak_sparepart as Rak, d.jumlahBeli_sparepart as Jumlah
        FROM transaksi_penjualans t 
        INNER JOIN detil_transaksi_spareparts d ON d.id_transaksi_fk =  t.id_transaksi
        INNER JOIN sparepart_cabangs sc ON sc.id_sparepartCabang = d.id_sparepartCabang_fk
        INNER JOIN spareparts s ON s.kode_sparepart = sc.kode_sparepart_fk
        WHERE t.id_transaksi = $id");

        $data2 = DB::select("SELECT t.id_transaksi as Id_Transaksi, j2.id_jasaService as KodeJasa, j2.nama_jasaService as NamaJasa
        FROM transaksi_penjualans t 
        INNER JOIN detil_transaksi_services j ON j.id_transaksi_fk = t.id_transaksi
        INNER JOIN jasa_services j2 ON j2.id_jasaService = j.id_jasaService_fk
        WHERE t.id_transaksi = $id");

        $data3 = DB::select("SELECT t.created_at as created_at, t.id_transaksi as Id_Transaksi, k.nama_konsumen as Cust, k.noTelp_konsumen as Telepon
        FROM transaksi_penjualans t 
        INNER JOIN detil_transaksi_spareparts d ON d.id_transaksi_fk = t.id_transaksi
        INNER JOIN konsumens k ON k.id_konsumen = d.id_konsumen_fk
        WHERE t.id_transaksi = $id");

        $data4 = DB::select("SELECT t.id_transaksi as Id_Transaksi, p.nama_pegawai as CS
        FROM transaksi_penjualans t 
        INNER JOIN pegawai_on_duties m ON m.id_transaksi_fk =  t.id_transaksi
        INNER JOIN pegawais p ON p.id_pegawai = m.id_pegawai_fk
        WHERE t.id_transaksi = $id");

        $data5 = DB::select("SELECT t.id_transaksi as Id_Transaksi,  p.nama_pegawai as Montir
        FROM transaksi_penjualans t 
        INNER JOIN detil_transaksi_services j ON j.id_transaksi_fk = t.id_transaksi
        INNER JOIN montir_on_duties m ON m.id_motorKonsumen_fk = j.id_motorKonsumen_fk
        INNER JOIN pegawais p ON p.id_pegawai = m.id_pegawai_fk
        WHERE t.id_transaksi = $id");

        $data6 = DB::select("SELECT t.id_transaksi as Id_Transaksi, n.merk_motor as Merk, n.tipe_motor as Tipe, p.plat_motorKonsumen as Plat 
        FROM transaksi_penjualans t 
        INNER JOIN detil_transaksi_services d ON d.id_transaksi_fk =  t.id_transaksi
        INNER JOIN montir_on_duties m ON m.id_motorKonsumen_fk = d.id_motorKonsumen_fk
        INNER JOIN motor_konsumens p ON p.id_motorKonsumen = m.id_motorKonsumen_fk
        INNER JOIN motors n ON n.id_motor = p.id_motor_fk
        WHERE t.Id_Transaksi = $id");

        $data7 = DB::select("SELECT t.id_transaksi as Id_Transaksi, t.kode_transaksi AS 'Kode_Transaksi'
        FROM transaksi_penjualans t 
        WHERE t.id_transaksi = $id");

        return response()->json([
            'status' => (bool) $data1,
            'data1' => $data1,
            'data2' => $data2,
            'data3' => $data3,
            'data4' => $data4,
            'data5' => $data5,
            'data6' => $data6,
            'data7' => $data7,
            'message' => $data1 ? 'Success' : 'Error',
        ]);
    }
}
