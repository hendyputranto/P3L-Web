<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetilTransaksiServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detil_transaksi_services', function (Blueprint $table) {
            $table->increments('id_detilTransaksiService');
            $table->unsignedInteger('id_transaksi_fk');
            $table->unsignedInteger('id_jasaService_fk');
            $table->unsignedInteger('id_motorKonsumen_fk');
            $table->float('subTotal_service');
            $table->string('status_service',15);
            $table->timestamps();

            $table->foreign('id_transaksi_fk')->references('id_transaksi')->on('transaksi_penjualans');
            $table->foreign('id_jasaService_fk')->references('id_jasaService')->on('jasa_services');
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
        Schema::dropIfExists('detil__transaksi_services');
    }
}
