<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Pegawai;

class PegawaiTransformer extends TransformerAbstract
{
    /**
     * Transform Barang.
     *
     * @param Service $service
     */
    public function transform(Pegawai $pegawai)
    {
        return [
            'id_pegawai' => $pegawai->id_pegawai,
            'id_role_fk' => $pegawai->id_role_fk,
            'nama_role' => $pegawai->role->nama_role,
            'id_cabang_fk' => $pegawai->id_cabang_fk,
            'nama_pegawai' => $pegawai->nama_pegawai,
            'alamat_pegawai' => $pegawai->alamat_pegawai,
            'noTelp_pegawai' => $pegawai->noTelp_pegawai,
            'gaji_pegawai' => $pegawai->gaji_pegawai,
            'username_pegawai' => $pegawai->username_pegawai,
            'password_pegawai' => $pegawai->password_pegawai,
        ];
    }
}