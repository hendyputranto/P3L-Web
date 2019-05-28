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
        
    public function sparepartTerlaris() {
        $data =DB::select(
            "SELECT MONTHNAME(STR_TO_DATE((m.bulan), '%m')) as Bulan,COALESCE(s.nama_sparepart,'') as Nama,COALESCE(s.tipe_sparepart,'') as Tipe,COALESCE(SUM(d.jumlahBeli_sparepart),'') as Total 
            FROM (SELECT '01' AS
            bulan
            UNION SELECT '02' AS
            bulan
            UNION SELECT '03' AS
            bulan
            UNION SELECT '04' AS
            bulan
            UNION SELECT '05' AS
            bulan
            UNION SELECT '06' AS
            bulan
            UNION SELECT '07'AS
            bulan
            UNION SELECT '08'AS
            bulan
            UNION SELECT '09' AS
            bulan
            UNION SELECT '10' AS
            bulan
            UNION SELECT '11' AS
            bulan
            UNION SELECT '12' AS
            bulan
            ) AS m LEFT JOIN transaksi_penjualans t ON MONTHNAME(t.tgl_transaksi) = MONTHNAME(STR_TO_DATE((m.bulan), '%m')) LEFT JOIN detil_transaksi_spareparts d ON 		t.id_transaksi=d.id_transaksi_fk
            LEFT JOIN sparepart_cabangs sp ON d.id_sparepartCabang_fk = sp.id_sparepartCabang
            LEFT JOIN spareparts s ON sp.kode_sparepart_fk = s.kode_sparepart
            where YEAR(t.tgl_transaksi)='2019' or YEAR(t.tgl_transaksi) is null OR t.status_transaksi = 'Sudah Lunas'
            GROUP BY m.bulan, YEAR(t.tgl_transaksi)");

        // $pdf = PDF::loadView('laporanSparepartTerlarisBulanan', compact('report', 'no', 'date', 'year', 'type'))->setPaper('a4', 'portrait');
        // return $pdf->stream();
        return response()->json($data, 200);
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
    public function cetakNotaPembayaranDesktop($id)
    {
        $data1 = DB::select("SELECT t.id_transaksi as id_transaksi, s.kode_sparepart as Kode, s.nama_sparepart as Nama, s.merk_sparepart as Merk,  d.jumlahBeli_sparepart as Jumlah, d.subTotal_sparepart as Subtotal
        FROM transaksi_penjualans t 
        INNER JOIN detil_transaksi_spareparts d ON d.id_transaksi_fk =  t.id_transaksi
        INNER JOIN sparepart_cabangs sc ON sc.id_sparepartCabang = d.id_sparepartCabang_fk
        INNER JOIN spareparts s ON s.kode_sparepart = sc.kode_sparepart_fk
        WHERE t.id_transaksi = $id");

        $data2 = DB::select("SELECT t.id_transaksi as Id_Transaksi, j2.id_jasaService as KodeJasa, j2.nama_jasaService as NamaJasa, j.subTotal_service as Subtotal
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
    public function cetakSuratPemesananDesktop($id)
    {
        $pengadaan = PengadaanSparepart::find($id);
        $pengadaan->statusCetak_pengadaan = 'Sudah Cetak';
        $pengadaan->save();

        $datas  = DB::select("SELECT sup.nama_supplier as Nama_Supplier, sup.alamat_supplier as Alamat, sup.noTelp_supplier as NoTelp, 	s.nama_sparepart as Nama_Barang,
                                s.merk_sparepart as Merk, s.tipe_sparepart as Tipe, d.satuan_pengadaan as Satuan, 		d.sub_total_sparepart as Jumlah
                                FROM pengadaan_spareparts 
                                LEFT JOIN detil_pengadaan_spareparts as d 
                                ON pengadaan_spareparts.id_pengadaan = d.id_pengadaan_fk 
                                LEFT JOIN suppliers as sup
                                ON pengadaan_spareparts.id_supplier_fk = sup.id_supplier
                                LEFT JOIN sparepart_cabangs as sc
                                ON d.id_sparepartCabang_fk = sc.id_sparepartCabang
                                LEFT JOIN spareparts as s
                                ON sc.kode_sparepart_fk = s.kode_sparepart
                                WHERE pengadaan_spareparts.id_Pengadaan = $id");
                    
        //return response()->json($datas, 200);
        return response()->json([
            'datas' => $datas,
            'message' => $datas ? 'Success' : 'Error',
        ]);
    }
    public function cetakSuratPemesanan($id)
    {
        $pengadaan = PengadaanSparepart::find($id);
        $pengadaan->statusCetak_pengadaan = 'Sudah Cetak';
        $pengadaan->save();

        $datas  = DB::select("SELECT sup.nama_supplier as Nama_Supplier, sup.alamat_supplier as Alamat, sup.noTelp_supplier as NoTelp, 	s.nama_sparepart as Nama_Barang,
                                s.merk_sparepart as Merk, s.tipe_sparepart as Tipe, d.satuan_pengadaan as Satuan, 		d.sub_total_sparepart as Jumlah
                                FROM pengadaan_spareparts 
                                LEFT JOIN detil_pengadaan_spareparts as d 
                                ON pengadaan_spareparts.id_pengadaan = d.id_pengadaan_fk 
                                LEFT JOIN suppliers as sup
                                ON pengadaan_spareparts.id_supplier_fk = sup.id_supplier
                                LEFT JOIN sparepart_cabangs as sc
                                ON d.id_sparepartCabang_fk = sc.id_sparepartCabang
                                LEFT JOIN spareparts as s
                                ON sc.kode_sparepart_fk = s.kode_sparepart
                                WHERE pengadaan_spareparts.id_Pengadaan = $id");
                    
        return response()->json($datas, 200);
    }
    public function pendapatanBulanan() {
        // $data = DB::select(
        //     "SELECT
        //     MONTHNAME(t.tgl_transaksi) as bulan,
        //     COALESCE(SUM(d.subTotal_sparepart),0) as Spareparts,
        //     COALESCE(SUM(ds.subTotal_service),0) as Services,
        //     COALESCE(SUM(t.total_transaksi),0) as Total
        //     FROM
        //         transaksi_penjualans as t
        //     LEFT JOIN detil_transaksi_spareparts as d ON t.id_transaksi=d.id_transaksi_fk 
        //     LEFT JOIN detil_transaksi_services as ds ON t.id_transaksi=ds.id_transaksi_fk
        //     WHERE
        //         YEAR(t.tgl_transaksi)='2019' or YEAR(t.tgl_transaksi) is null or t.status_transaksi = 'Sudah Lunas'
        //     GROUP BY
        //         bulan, YEAR(t.tgl_transaksi)
        //     ORDER BY bulan DESC");

        $data = DB::select(
            "SELECT MONTHNAME(STR_TO_DATE((m.bulan), '%m')) as Bulan,COALESCE(SUM(d.subTotal_sparepart),0) as Sparepart,COALESCE(SUM(e.subTotal_service),0) as Service,COALESCE(SUM(p.total_transaksi),0) as Total 
            FROM (SELECT '01' AS
            bulan
            UNION SELECT '02' AS
            bulan
            UNION SELECT '03' AS
            bulan
            UNION SELECT '04' AS
            bulan
            UNION SELECT '05' AS
            bulan
            UNION SELECT '06' AS
            bulan
            UNION SELECT '07'AS
            bulan
            UNION SELECT '08'AS
            bulan
            UNION SELECT '09' AS
            bulan
            UNION SELECT '10' AS
            bulan
            UNION SELECT '11' AS
            bulan
            UNION SELECT '12' AS
            bulan
            ) AS m LEFT JOIN transaksi_penjualans p ON MONTHNAME(p.tgl_transaksi) = MONTHNAME(STR_TO_DATE((m.bulan), '%m')) LEFT JOIN detil_transaksi_spareparts d ON p.id_transaksi=d.id_transaksi_fk
            LEFT JOIN detil_transaksi_services e ON p.id_transaksi=e.id_transaksi_fk
            where YEAR(p.tgl_transaksi)='2019' or YEAR(p.tgl_transaksi) is null 
            GROUP BY m.bulan, YEAR(p.tgl_transaksi)");

        // $data = DB::select(
        //     'SELECT
        //     bulan,
        //     SUM(service) "service",
        //     SUM(sparepart) "sparepart",
        //     SUM(service) + SUM(sparepart) "total"
        //     FROM
        //         (
        //         SELECT
        //             MONTH(tgl_transaksi) "bulan",
        //             subTotal_service "service",
        //             0 "sparepart"
        //         FROM
        //             transaksi_penjualans
        //         JOIN detil_transaksi_services USING(id_transaksi)
        //         WHERE
        //             status_transaksi = "Sudah Lunas"
        //         UNION ALL
        //         SELECT
        //             MONTH(tgl_transaksi) "bulan",
        //             0 "service",
        //             subTotal_sparepart "sparepart"
        //         FROM
        //             transaksi_penjualans
        //         JOIN detil_transaksi_spareparts USING(id_transaksi)
        //         WHERE
        //             status_transaksi = "Sudah Lunas"
        //     ) 
        //     GROUP BY
        //         bulan');

            return response()->json($data, 200);
    }

    public function pendapatanBulananDesktop($tahun) {
        $data = DB::select(
            "SELECT MONTHNAME(STR_TO_DATE((m.bulan), '%m')) as Bulan,COALESCE(SUM(d.subTotal_sparepart),0) as Sparepart,COALESCE(SUM(e.subTotal_service),0) as Service,COALESCE(SUM(p.total_transaksi),0) as Total 
            FROM (SELECT '01' AS
            bulan
            UNION SELECT '02' AS
            bulan
            UNION SELECT '03' AS
            bulan
            UNION SELECT '04' AS
            bulan
            UNION SELECT '05' AS
            bulan
            UNION SELECT '06' AS
            bulan
            UNION SELECT '07'AS
            bulan
            UNION SELECT '08'AS
            bulan
            UNION SELECT '09' AS
            bulan
            UNION SELECT '10' AS
            bulan
            UNION SELECT '11' AS
            bulan
            UNION SELECT '12' AS
            bulan
            ) AS m LEFT JOIN transaksi_penjualans p ON MONTHNAME(p.tgl_transaksi) = MONTHNAME(STR_TO_DATE((m.bulan), '%m')) LEFT JOIN detil_transaksi_spareparts d ON p.id_transaksi=d.id_transaksi_fk
            LEFT JOIN detil_transaksi_services e ON p.id_transaksi=e.id_transaksi_fk
            where YEAR(p.tgl_transaksi)= $tahun or YEAR(p.tgl_transaksi) is null 
            GROUP BY m.bulan, YEAR(p.tgl_transaksi)");

            return response()->json([
                'data' => $data,
                'message' => $data ? 'Success' : 'Error',
            ]);
    }
    public function pendapatanPertahunDesktop() {
        $data = DB::select(
            "SELECT  year(t.tgl_transaksi) as TAHUN,
             s.nama_cabang as Cabang, SUM(t.total_transaksi) as TOTAL 
             FROM transaksi_penjualans as t 
             INNER JOIN cabangs as s ON t.id_cabang_fk = s.id_cabang 
             WHERE t.status_transaksi = 'Sudah Lunas' 
             GROUP BY YEAR(t.tgl_transaksi), s.nama_cabang");

            return response()->json([
                'data' => $data,
                'message' => $data ? 'Success' : 'Error',
            ]);
    }
    public function penjualanJasa(){
        $data = DB::select(
            "SELECT
            p.merk_motor AS Merk,
            p.tipe_motor AS Tipe,
            s.nama_jasaService AS Nama_service,
            Count( t.tgl_transaksi ) AS Jumlah_service 
            FROM
                motors AS p
                INNER JOIN motor_konsumens as q ON q.id_motor_fk = p.id_motor INNER JOIN detil_transaksi_services AS r ON r.id_motorKonsumen_fk = q.id_motorKonsumen INNER JOIN jasa_services AS s ON r.id_jasaService_fk = s.id_jasaService INNER JOIN transaksi_penjualans AS t ON r.id_transaksi_fk = t.id_transaksi 
            WHERE
                MONTHNAME(t.tgl_transaksi) = 'May' 
                AND YEAR (t.tgl_transaksi) = 2019 
            GROUP BY
            p.tipe_motor,
            p.merk_motor,
            s.nama_jasaService");

        return response()->json($data, 200);

    }
    public function penjualanJasaDesktop($tahun, $bulan) {
        $data = DB::select(
            "SELECT
            p.merk_motor AS Merk,
            p.tipe_motor AS Tipe,
            s.nama_jasaService AS Nama_service,
            Count( t.tgl_transaksi ) AS Jumlah_service 
            FROM
                motors AS p
                INNER JOIN motor_konsumens as q ON q.id_motor_fk = p.id_motor INNER JOIN detil_transaksi_services AS r ON r.id_motorKonsumen_fk = q.id_motorKonsumen INNER JOIN jasa_services AS s ON r.id_jasaService_fk = s.id_jasaService INNER JOIN transaksi_penjualans AS t ON r.id_transaksi_fk = t.id_transaksi 
            WHERE
                MONTHNAME(t.tgl_transaksi) = '$bulan' 
                AND YEAR (t.tgl_transaksi) = $tahun 
            GROUP BY
            p.tipe_motor,
            p.merk_motor,
            s.nama_jasaService");

            return response()->json([
                'data' => $data,
                'message' => $data ? 'Success' : 'Error',
            ]);
    }
    public function pengeluaranBulananDesktop($tahun) {
        $data = DB::select(
            "SELECT MONTHNAME(STR_TO_DATE((m.bulan), '%m')) as Bulan, COALESCE(SUM(t.totalHarga_pengadaan),0) as Jumlah_Pengeluaran 
            FROM (SELECT '01' AS
            bulan
            UNION SELECT '02' AS
            bulan
            UNION SELECT '03' AS
            bulan
            UNION SELECT '04' AS
            bulan
            UNION SELECT '05' AS
            bulan
            UNION SELECT '06' AS
            bulan
            UNION SELECT '07'AS
            bulan
            UNION SELECT '08'AS
            bulan
            UNION SELECT '09' AS
            bulan
            UNION SELECT '10' AS
            bulan
            UNION SELECT '11' AS
            bulan
            UNION SELECT '12' AS
            bulan
            ) AS m LEFT JOIN pengadaan_spareparts as t ON MONTHNAME(t.tgl_pengadaan) = MONTHNAME(STR_TO_DATE((m.bulan), '%m'))
            WHERE t.status_pengadaan = 'Sudah Selesai' AND YEAR(t.tgl_pengadaan) = $tahun or YEAR(t.tgl_pengadaan) is null 
            GROUP BY YEAR(t.tgl_pengadaan), m.bulan");

            return response()->json([
                'data' => $data,
                'message' => $data ? 'Success' : 'Error',
            ]);
    }
    public function pengeluaranBulanan()
    {
        $data = DB::select(
            "SELECT MONTHNAME(STR_TO_DATE((m.bulan), '%m')) as Bulan, COALESCE(SUM(t.totalHarga_pengadaan),0) as Jumlah_Pengeluaran 
            FROM (SELECT '01' AS
            bulan
            UNION SELECT '02' AS
            bulan
            UNION SELECT '03' AS
            bulan
            UNION SELECT '04' AS
            bulan
            UNION SELECT '05' AS
            bulan
            UNION SELECT '06' AS
            bulan
            UNION SELECT '07'AS
            bulan
            UNION SELECT '08'AS
            bulan
            UNION SELECT '09' AS
            bulan
            UNION SELECT '10' AS
            bulan
            UNION SELECT '11' AS
            bulan
            UNION SELECT '12' AS
            bulan
            ) AS m LEFT JOIN pengadaan_spareparts as t ON MONTHNAME(t.tgl_pengadaan) = MONTHNAME(STR_TO_DATE((m.bulan), '%m'))
            WHERE t.status_pengadaan = 'Sudah Selesai' AND YEAR(t.tgl_pengadaan) = 2019 or YEAR(t.tgl_pengadaan) is null 
            GROUP BY YEAR(t.tgl_pengadaan), m.bulan");

        return response()->json($data, 200);
    }

    public function sisaStokDesktop($tahun,$tipeSparepart) {
        $data = DB::select(
            "SELECT
            MONTHNAME(STR_TO_DATE((m.bulan), '%m')) AS Bulan,
            COALESCE(q.stokSisa_sparepart ,0) AS SisaStok
            FROM (SELECT '01' AS
                bulan
                UNION SELECT '02' AS
                bulan
                UNION SELECT '03' AS
                bulan
                UNION SELECT '04' AS
                bulan
                UNION SELECT '05' AS
                bulan
                UNION SELECT '06' AS
                bulan
                UNION SELECT '07'AS
                bulan
                UNION SELECT '08'AS
                bulan
                UNION SELECT '09' AS
                bulan
                UNION SELECT '10' AS
                bulan
                UNION SELECT '11' AS
                bulan
                UNION SELECT '12' AS
                bulan
                ) AS m LEFT JOIN
            spareparts AS p ON MONTHNAME(p.updated_at) = MONTHNAME(STR_TO_DATE((m.bulan), '%m'))
            LEFT JOIN sparepart_cabangs AS q ON p.kode_sparepart = q.kode_sparepart_fk
            WHERE
                p.nama_sparepart = '$tipeSparepart' OR YEAR(p.updated_at)= $tahun or YEAR(p.updated_at) is null
            GROUP BY
                m.bulan, YEAR(p.updated_at)");

            return response()->json([
                'data' => $data,
                'message' => $data ? 'Success' : 'Error',
            ]);
    }
    public function sisaStok()
    {
        $data = DB::select(
            "SELECT
            MONTHNAME(STR_TO_DATE((m.bulan), '%m')) AS Bulan,
            COALESCE(q.stokSisa_sparepart ,0) AS SisaStok
            FROM (SELECT '01' AS
                bulan
                UNION SELECT '02' AS
                bulan
                UNION SELECT '03' AS
                bulan
                UNION SELECT '04' AS
                bulan
                UNION SELECT '05' AS
                bulan
                UNION SELECT '06' AS
                bulan
                UNION SELECT '07'AS
                bulan
                UNION SELECT '08'AS
                bulan
                UNION SELECT '09' AS
                bulan
                UNION SELECT '10' AS
                bulan
                UNION SELECT '11' AS
                bulan
                UNION SELECT '12' AS
                bulan
                ) AS m LEFT JOIN
            spareparts AS p ON MONTHNAME(p.updated_at) = MONTHNAME(STR_TO_DATE((m.bulan), '%m'))
            LEFT JOIN sparepart_cabangs AS q ON p.kode_sparepart = q.kode_sparepart_fk
            WHERE
                p.nama_sparepart = 'Kelistrikan' OR YEAR(p.updated_at)= 2019 or YEAR(p.updated_at) is null
            GROUP BY
                m.bulan, YEAR(p.updated_at)");

        return response()->json($data, 200);
    }

    public function pendapatanTahunan(){
        $data = DB::select(
            "SELECT  year(t.tgl_transaksi) as TAHUN,
             s.nama_cabang as Cabang, SUM(t.total_transaksi) as TOTAL 
             FROM transaksi_penjualans as t 
             INNER JOIN cabangs as s ON t.id_cabang_fk = s.id_cabang 
             WHERE t.status_transaksi = 'Sudah Lunas' 
             GROUP BY YEAR(t.tgl_transaksi), s.nama_cabang");

        return response()->json($data, 200);
    }
    
    public function sparepartTerlarisDesktop($tahun) {
        $data =DB::select(
            "SELECT MONTHNAME(STR_TO_DATE((m.bulan), '%m')) as Bulan,COALESCE(s.nama_sparepart,'') as Nama,COALESCE(s.tipe_sparepart,'') as Tipe,COALESCE(SUM(d.jumlahBeli_sparepart),'') as Total 
            FROM (SELECT '01' AS
            bulan
            UNION SELECT '02' AS
            bulan
            UNION SELECT '03' AS
            bulan
            UNION SELECT '04' AS
            bulan
            UNION SELECT '05' AS
            bulan
            UNION SELECT '06' AS
            bulan
            UNION SELECT '07'AS
            bulan
            UNION SELECT '08'AS
            bulan
            UNION SELECT '09' AS
            bulan
            UNION SELECT '10' AS
            bulan
            UNION SELECT '11' AS
            bulan
            UNION SELECT '12' AS
            bulan
            ) AS m LEFT JOIN transaksi_penjualans t ON MONTHNAME(t.tgl_transaksi) = MONTHNAME(STR_TO_DATE((m.bulan), '%m')) LEFT JOIN detil_transaksi_spareparts d ON 		t.id_transaksi=d.id_transaksi_fk
            LEFT JOIN sparepart_cabangs sp ON d.id_sparepartCabang_fk = sp.id_sparepartCabang
            LEFT JOIN spareparts s ON sp.kode_sparepart_fk = s.kode_sparepart
            where YEAR(t.tgl_transaksi)= $tahun or YEAR(t.tgl_transaksi) is null OR t.status_transaksi = 'Sudah Lunas'
            GROUP BY m.bulan, YEAR(t.tgl_transaksi)");

            return response()->json([
                'data' => $data,
                'message' => $data ? 'Success' : 'Error',
            ]);
    }
}
