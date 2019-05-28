<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    // public function pengeluaranBulanan($tahun) {
    //     $data = DB::select(
    //         'SELECT
    //             MONTH(tanggal_pemesanan_barang) "bulan",
    //             SUM(total_biaya) "pengeluaran"
    //         FROM
    //             transaksi__pemesanan__barangs
    //         WHERE
    //         status = "Dicetak" AND YEAR(tanggal_pemesanan_barang) = :tahun
    //         GROUP BY
    //             MONTH(tanggal_pemesanan_barang)', ['tahun' => $tahun]);

    //     return response()->json($data, 200);
    // }

    // public function penjualanJasa($bulan, $tahun) {
    //     $data = DB::select(
    //         'SELECT
    //             merk_motor,
    //             tipe_motor,
    //             nama_jasa_servis,
    //             SUM(jumlah_penjualan_jasa) "total"
    //         FROM
    //             detail__transaksi__penjualan__jas
    //         JOIN kendaraan__konsumens USING(kode_kendaraan)
    //         JOIN motors USING(kode_motor)
    //         JOIN jasa__servis USING(kode_jasa_servis)
    //         JOIN transaksi__penjualanns USING(kode_penjualan)
    //         where month(tanggal_transaksi)= :bulan and year(tanggal_transaksi) = :tahun
    //         and keterangan_transaksi = "Lunas"
    //         GROUP BY
    //             merk_motor,
    //             tipe_motor,
    //             nama_jasa_servis', ['bulan' => $bulan, 'tahun' => $tahun]);

    //     return response()->json($data, 200);
    // }

    // public function pendapatanBulanan($tahun) {
    //     $data = DB::select(
    //         'SELECT
    //         bulan,
    //         tahun,
    //         SUM(service) "service",
    //         SUM(sparepart) "sparepart",
    //         SUM(service) + SUM(sparepart) "total"
    //         FROM
    //             (
    //             SELECT
    //                 MONTH(tanggal_transaksi) "bulan",
    //                 YEAR(tanggal_transaksi) "tahun",
    //                 subtotal_jasa "service",
    //                 0 "sparepart"
    //             FROM
    //                 transaksi__penjualanns
    //             JOIN detail__transaksi__penjualan__jas USING(kode_penjualan)
    //             WHERE
    //                 keterangan_transaksi = "Lunas"
    //             UNION ALL
    //             SELECT
    //                 MONTH(tanggal_transaksi) "bulan",
    //                 YEAR(tanggal_transaksi) "tahun",
    //                 0 "service",
    //                 subtotal_sparepart "sparepart"
    //             FROM
    //                 transaksi__penjualanns
    //             JOIN detail__transaksi__penjualan__spares USING(kode_penjualan)
    //             WHERE
    //                 keterangan_transaksi = "Lunas"
    //         ) a
    //         GROUP BY
    //             bulan,
    //             tahun
    //         HAVING
    //             tahun = :tahun', ['tahun' => $tahun]);

    //     return response()->json($data, 200);
    // }

    // public function sparepartTerlaris($tahun) {
    //     $data =DB::select(
    //         'SELECT
    //         bulan,
    //         nama,
    //         tipe,
    //         MAX(total) "total"
    //         FROM
    //             (
    //             SELECT
    //                 MONTH(tanggal_transaksi) AS bulan,
    //                 nama_sparepart AS nama,
    //                 tipe_sparepart AS tipe,
    //                 SUM(jumlah_penjualan_sparepart) AS total
    //             FROM
    //                 detail__transaksi__penjualan__spares
    //             JOIN transaksi__penjualanns USING(kode_penjualan)
    //             JOIN spareparts using(kode_sparepart)
    //             WHERE
    //                 YEAR(tanggal_transaksi) = :tahun AND keterangan_transaksi = "Lunas"
    //             GROUP BY
    //                 kode_sparepart,
    //                 bulan
    //             ORDER BY
    //                 total
    //             DESC
    //         ) q
    //         GROUP BY
    //             bulan
    //         ORDER BY
    //             bulan ASC',
    //             ['tahun' => $tahun]);

    //     return response()->json($data, 200);
    // }

    public function sisaStok($barang, $tahun) {
        $data = DB::select(
            'SELECT
            MONTH(tgl_barangDatang) "bulan",
            kode_sparepart,
            tipe_sparepart,
            stokSisa_sparepart
            FROM
                pengadaan_spareparts
            JOIN spareparts ON pengadaan_spareparts.id_pengadaan=spareparts.kode_sparepart
            JOIN sparepart_cabangs ON spareparts.kode_sparepart=sparepart_cabangs.kode_sparepart_fk
            WHERE
                tipe_sparepart = :barang AND tgl_barangDatang IN(
                SELECT
                    MAX(tgl_barangDatang)
                FROM
                    pengadaan_spareparts
                JOIN spareparts ON pengadaan_spareparts.id_pengadaan=spareparts.kode_sparepart
                WHERE
                    YEAR(tgl_barangDatang) = :tahun AND tipe_sparepart = :barang1
                GROUP BY
                    MONTH(tgl_barangDatang),
                    YEAR(tgl_barangDatang)
                )', 
            ['barang' => $barang, 'tahun' => $tahun, 'barang1' => $barang]);

        return response()->json($data, 200);  
    }

    public function pendapatanTahunan() {
        $data = DB::select(
            'SELECT year(t.tgl_transaksi) as TAHUN, s.nama_cabang as Cabang, 
            SUM(t.total_transaksi) as TOTAL FROM transaksi_penjualans as t 
            INNER JOIN cabangs as s ON t.id_cabang_fk = s.id_cabang 
            WHERE t.status_transaksi = "Sudah Lunas" 
            GROUP BY YEAR(t.tgl_transaksi), s.nama_cabang');
            //ORDER BY Tahun, Cabang ASC', [1]);

            return response()->json($data, 200);
    }
}
