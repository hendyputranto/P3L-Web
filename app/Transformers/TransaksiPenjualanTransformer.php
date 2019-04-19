<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\TransaksiPenjualan;
class TransaksiPenjualanTransformer extends TransformerAbstract
{
    /**
     * Transform Barang.
     *
     * @param Service $service
     */
    public function transform(TransaksiPenjualan $transaksi)
    {
        return [
            'id_transaksi' => $transaksi->id_transaksi,
            'id_cabang_fk' => $transaksi->id_cabang_fk,
            'kode_transaksi' => $transaksi->kode_transaksi,
            'tgl_transaksi' => $transaksi->tgl_transaksi,
            'diskon' => $transaksi->diskon,
            'total_transaksi' => $transaksi->total_transaksi,
            'status_transaksi' => $transaksi->status_transaksi,
            
        ];
    }
}