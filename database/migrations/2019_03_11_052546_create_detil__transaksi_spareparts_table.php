<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetilTransaksiSparepartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detil__transaksi_spareparts', function (Blueprint $table) {
            $table->increments('id_detilTransaksiSparepart');
            $table->unsignedInteger('id_transaksi_fk');
            $table->unsignedInteger('id_sparepartCabang_fk');
            $table->unsignedInteger('id_motorKonsumen_fk');
            $table->integer('jumlahBeli_saprepart');
            $table->float('subTotal_sparepart');
            $table->timestamps();

            $table->foreign('id_transaksi_fk')->references('id_transaksi')->on('transaksi_penjualans');
            $table->foreign('id_sparepartCabang_fk')->references('id_sparepartCabang')->on('sparepart_cabangs');
            $table->foreign('id_motorKonsumen_fk')->references('id_motorKonsumen')->on('motor_konsumens');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detil__transaksi_spareparts');
    }
}
