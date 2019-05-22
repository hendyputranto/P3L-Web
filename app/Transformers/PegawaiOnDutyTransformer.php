<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Pegawai_OnDuty;

class PegawaiOnDutyTransformer extends TransformerAbstract
{
    /**
     * Transform Barang.
     *
     * @param Service $service
     */
    public function transform(Pegawai_OnDuty $pegawaionduty)
    {
        return [
            'id_pegawaiOnDuty' => $pegawaionduty->id_pegawaiOnDuty,
            'id_pegawai_fk' => $pegawaionduty->id_pegawai_fk,
            'nama_pegawai' => $pegawaionduty->pegawai->nama_pegawai,
            'id_transaksi_fk' => $pegawaionduty->id_transaksi_fk,
        ];
    }
}