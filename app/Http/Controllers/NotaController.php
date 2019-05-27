<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotaController extends Controller
{
    public function pengeluaranBulanan($tahun) {
        $data = DB::select(
            'SELECT MONTH(Tanggal) "bulan", g + p "pengeluaran" 
            FROM
            (
                SELECT
                    4 * SUM(gaji_pegawai) g
                FROM
                    pegawais
            ) gaji
            JOIN(
                SELECT
                    SUM(Total) p
                FROM
                    pengadaans
            ) peng,
            pengadaans
            WHERE
                status = "Dicetak" and year(Tanggal) = :tahun
            GROUP BY
                MONTH(Tanggal)', ['tahun' => $tahun]);
        return response()->json($data, 200);
    }

    public function penjualanJasa($bulan, $tahun) {
        $data = DB::select(
            'SELECT
                m.Nama,
                t.Tipe,
                j.Nama as Nama_Jasa,
                SUM(d.Jumlah) "total"
            FROM
                detil__transaksi__services d
            JOIN motor_konsumens USING(id_motorKonsumen)
            JOIN jasa_services j USING(id_jasaService)
            join motors m USING(id_motor)
            join jasa_services USING(id_jasaService)
            where month(Tanggal)= :bulan and year(Tanggal) = :tahun
            GROUP BY
                j.Nama', ['bulan' => $bulan, 'tahun' => $tahun]);

        return response()->json($data, 200);
    }

    public function pendapatanBulanan($tahun) {
        $data = DB::select(
            'SELECT
                bulan,
                tahun,
                sum(service) "service",
                sum(sparepart) "sparepart",
                sum(service)+sum(sparepart) "total"
            FROM
                (
                SELECT
                    MONTH(p.Tanggal) "bulan",
                    year(p.Tanggal) "tahun",
                    p.Subtotal "service",
                    0 "sparepart"
                FROM
                    jasa_services p
                JOIN detil__transaksi__services USING(id_detilTransaksiService)
                UNION ALL
                SELECT
                    MONTH(s.Tanggal) "bulan",
                    year(s.Tanggal) "tahun",
                    0 "service",
                    s.Subtotal "sparepart"
                FROM
                    transaksi_penjualans s
                JOIN detil__transaksi__spareparts USING(id_detilTransaksiSparepart)
            ) a
            GROUP BY
                bulan, tahun
            HAVING tahun = :tahun', ['tahun' => $tahun]);

        return response()->json($data, 200);
    }

    public function sparepartTerlaris($tahun) {
        $data =DB::select(
            'SELECT
					bulan,
					nama,
					tipe,
					MAX(total) "total"
				FROM
					(
					SELECT
						MONTH(Tanggal) AS bulan,
						Nama AS nama,
						Tipe AS tipe,
						SUM(Jumlah) AS total
					FROM
						detil__transaksi__spareparts
					JOIN transaksi_penjualans USING(id_transaksi)
					JOIN spareparts USING(kode_sparepart)
					WHERE
						YEAR(Tanggal) = :tahun AND Status = "Dibayar"
					GROUP BY
						Kode,
						bulan
					ORDER BY
						total
					DESC
				) q
				GROUP BY
					bulan
				ORDER BY
					bulan ASC',
                ['tahun' => $tahun]);

        return response()->json($data, 200);
    }

    public function sisaStok($barang, $tahun) {
        $data = DB::select(
            'SELECT
            MONTH(Tanggal) "bulan",
            Kode,
            Tipe,
            sisa_stok
            FROM
                historis
            JOIN spareparts USING(kode_sparepart)
            WHERE
                Tipe = :barang AND Tanggal IN(
                SELECT
                    MAX(Tanggal)
                FROM
                    historis
                JOIN spareparts USING(kode_sparepart)
                WHERE
                    YEAR(Tanggal) = :tahun AND Tipe = :barang1
                GROUP BY
                    MONTH(Tanggal),
                    YEAR(Tanggal)
                )', 
            ['barang' => $barang, 'tahun' => $tahun, 'barang1' => $barang]);

        return response()->json($data, 200);  
    }

    
	public function pendapatanTahunan()
	{
		$data = DB::select(
            'SELECT
			 year(Tanggal) as tahun,
				c.Alamat,
				SUM(Grandtotal) as total
			FROM
				pegawai__on_duties
			JOIN pegawais USING(id_pegawai)
			JOIN transaksi_penjualanss USING(id_transaksi)
			JOIN cabangs c USING(id_cabang)
			WHERE
				Role = "CS" 
			GROUP BY
				C.Alamat, year(Tanggal)
			');

        return response()->json($data, 200);  
    
		
		
		
	}

    public function getSatukendaraan($id) {
        $kendaraan = DB::select(
            'SELECT
                merk_motor,
                tipe_motor,
                plat_motor, 
                nama_pegawai
            FROM
                motors
            JOIN motors USING(tipe_motor)
            JOIN motors USING(merk_motor)
            join pegawais using (id_pegawai)
            WHERE
                id_motor = :id', ['id' => $id]
        );

        return response()->json($kendaraan, 200);
    }
     //ini buat dapet data-data detail penjualan sparepart di suatu transaksi, berguna pas di Nota Lunas
     public function getDetailPenjualanSparepart($id) {
        $detailPenjualanSparepart = DetailPenjualanSparepart::where('id_transaksi', $id)->with('sparepart')->get();
        if(is_null($detailPenjualanSparepart))
            return response()->json(['status' => 'detail penjualan sparepart'], 404);
        else
            return response()->json($detailPenjualanSparepart, 200);
    }
    
     //ini buat dapet data-data detail penjualan jasa service dari SETIAP motor di suatu transaksi, berguna pas di SPK
     public function getDetailPenjualanJasa($id, $kendaraan) {
        $detailPenjualanJasa = DetailPenjualanJasa::where('no_transaksi', $id)
        ->where('id_kendaraan', $kendaraan)->with('jasa_service')->get();
        if(!$detailPenjualanJasa)
            return response()->json(['status' => 'detail penjualan jasa not found'], 404);
        else
            return response()->json($detailPenjualanJasa, 200);
    }
}

