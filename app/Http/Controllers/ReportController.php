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

    public function LaporanPenjualanJasa(){
        $query = DB::table('motors')
                ->join('motor_konsumens', 'motors.id_motor', '=', 'motor_konsumens.id_motor_fk')
                ->join('detil_transaksi_services', 'motor_konsumens.id_motorKonsumen', '=', 'detil_transaksi_services.id_motorKonsumen_fk')
                ->join('jasa_services', 'detil_transaksi_services.id_jasaService_fk', '=', 'jasa_services.id_jasaService')
                ->join( 'transaksi_penjualans', 'detil_transaksi_services.id_transaksi_fk', '=', 'transaksi_penjualans.id_transaksi')
                ->select('motors.tipe_motor as TIPE' ,'motors.merk_motor as MERK', 'jasa_services.nama_jasaService as NAMAJASA')
                ->get();
        // $query = DB::select("SELECT p.merk_motor AS Merk, p.tipe_motor AS Tipe, s.nama_jasaService AS `NamaService`, Count( t.tgl_transaksi ) AS `JumlahService` 
        //                         FROM motors AS p INNER JOIN motor_konsumens as q ON q.id_motor_fk = p.id_motor INNER JOIN detil_transaksi_services AS r ON r.id_motorKonsumen_fk = q.id_motorKonsumen INNER JOIN jasa_services AS s ON r.id_jasaService_fk = s.id_jasaService INNER JOIN transaksi_penjualans AS t ON r.id_transaksi_fk = t.id_transaksi 
        //                         WHERE MONTHNAME( t.tgl_transaksi) = 'Mei' AND YEAR ( t.tgl_transaksi) = 2019 
        //                         GROUP BY p.tipe_motor, p.merk_motor, s.nama_jasaService");
        $count=count($query);
        $label  = [];
        $data   = [];
        $test   = [];
       // $jumlah = [];
        for($i=0;$i<$count;$i++)
        {
            $label[$i]  = $query[$i]->MERK;
            $data[$i]   = $query[$i]->TIPE;
            $test[$i]   = $query[$i]->NAMAJASA;
            // $jumlah[$i] = $query[$i]->JumlahService;
        }
        return view('laporanpenjualanjasa', ['query'=>$query, 'label'=>$label, 'data'=>$data, 'test'=>$test, 'no'=>0]);

    }
        
    public function cetakSuratPerintahKerjaDesktop($id)
    {
        $data1 = DB::select("SELECT t.id_transaksi as id_transaksi, s.kode_sparepart as Kode, s.nama_sparepart as Nama, s.merk_sparepart as Merk, s.letak_sparepart as Rak, d.Jumlah as Jumlah
        FROM transaksi_penjualans t 
        INNER JOIN detail_spareparts d ON d.Id_Transaksi =  t.Id_Transaksi
        INNER JOIN spareparts s ON s.Kode_Sparepart = d.Kode_Sparepart
        WHERE t.Id_Transaksi = $id");

        $data2 = DB::select("SELECT t.Id_Transaksi as Id_Transaksi, j2.Id_Jasa as KodeJasa, j2.Nama_Jasa as NamaJasa
        FROM transaksi_penjualans t 
        INNER JOIN detail_jasas j ON j.Id_Transaksi = t.Id_Transaksi
        INNER JOIN jasas j2 ON j2.Id_Jasa = j.Id_Jasa
        WHERE t.Id_Transaksi = $id");

        $data3 = DB::select("SELECT t.created_at as created_at, t.Id_Transaksi as Id_Transaksi, k.Nama_Konsumen as Cust, k.Telepon_Konsumen as Telepon
        FROM transaksi_penjualans t 
        INNER JOIN konsumens k ON k.Id_Konsumen = t.Id_Konsumen
        WHERE t.Id_Transaksi = $id");

        $data4 = DB::select("SELECT t.Id_Transaksi, p.Nama_Pegawai as CS
        FROM transaksi_penjualans t 
        INNER JOIN pegawai_on_duties m ON m.Id_Transaksi =  t.Id_Transaksi
        INNER JOIN pegawais p ON p.Id_Pegawai = m.Id_Pegawai
        WHERE t.Id_Transaksi = $id");

        $data5 = DB::select("SELECT t.Id_Transaksi, p.Nama_Pegawai as Montir
        FROM transaksi_penjualans t 
        INNER JOIN detail_spareparts d ON d.Id_Transaksi =  t.Id_Transaksi
        INNER JOIN montirs m ON m.Id_Jasa_Montir = d.Id_Jasa_Montir
        INNER JOIN pegawais p ON p.Id_Pegawai = m.Id_Pegawai
        WHERE t.Id_Transaksi = $id");

        $data6 = DB::select("SELECT t.Id_Transaksi, p.Nama_Pegawai as Montir
        FROM transaksi_penjualans t 
        INNER JOIN detail_jasas d ON d.Id_Transaksi =  t.Id_Transaksi
        INNER JOIN montirs m ON m.Id_Jasa_Montir = d.Id_Jasa_Montir
        INNER JOIN pegawais p ON p.Id_Pegawai = m.Id_Pegawai
        WHERE t.Id_Transaksi = $id");

        $data7 = DB::select("SELECT t.Id_Transaksi, CONCAT(t.Jenis_Transaksi,'-',t.created_at,'-',t.Id_Transaksi) AS 'Kode Transaksi'
        FROM transaksi_penjualans t 
        WHERE t.Id_Transaksi = $id");

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
