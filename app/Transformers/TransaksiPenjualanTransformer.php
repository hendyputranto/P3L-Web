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

     protected $defaultIncludes = [
        'detil_TransaksiSparepart',
        'detil_TransaksiService',
        'pegawai_on_duty'
     ];
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
            'nama_cabang' => $transaksi->cabang->nama_cabang
            //'nama_konsumen' => $transaksi->detil_transaksi_sparepart->konsumen->nama_konsumen,
            
        ];
    }
    public function includeDetilTransaksiSparepart(TransaksiPenjualan $transaksiPenjualan)
    {
        //collection itu seperti array
        return $this->collection($transaksiPenjualan->detil_transaksi_sparepart, new DetilTransaksiSparepartTransformer);
    }
    public function includeDetilTransaksiService(TransaksiPenjualan $transaksiPenjualan)
    {
        //collection itu seperti array
        return $this->collection($transaksiPenjualan->detil_transaksi_service, new DetilTransaksiServiceTransformer);
    }
    public function includePegawaiOnDuty(TransaksiPenjualan $transaksiPenjualan)
    {
        return $this->collection($transaksiPenjualan->pegawai_onduty, new PegawaiOnDutyTransformer);
    }
}