<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePegawaiOnDutiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai__on_duties', function (Blueprint $table) {
            $table->increments('id_pegawaiOnDuty');
            $table->unsignedInteger('id_pegawai_fk');
            $table->unsignedInteger('id_transaksi_fk');
            $table->timestamps();

            $table->foreign('id_pegawai_fk')->references('id_pegawai')->on('Pegawai');
            $table->foreign('id_transaksi_fk')->references('id_transaksi')->on('TransaksiPenjualan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawai__on_duties');
    }
}
