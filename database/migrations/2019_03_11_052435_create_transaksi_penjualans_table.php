<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksiPenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_penjualans', function (Blueprint $table) {
            $table->increments('id_transaksi');
            $table->unsignedInteger('id_cabang_fk');
            $table->date('tgl_transaksi');
            $table->float('diskon');
            $table->float('total_transaksi');
            $table->string('status_transaksi');
            $table->timestamps();

            $table->foreign('id_cabang_fk')->references('id_cabang')->on('cabangs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_penjualans');
    }
}
