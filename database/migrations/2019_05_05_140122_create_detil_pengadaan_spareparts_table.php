<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetilPengadaanSparepartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detil_pengadaan_spareparts', function (Blueprint $table) {
            $table->increments('id_detilPengadaanSparepart');
            $table->unsignedInteger('id_pengadaan_fk');
            $table->unsignedInteger('id_sparepartCabang_fk');
            $table->integer('satuan_pengadaan');
            $table->float('sub_total_sparepart');
            $table->integer('totalBarang_datang');
            $table->timestamps();

            $table->foreign('id_sparepartCabang_fk')->references('id_sparepartCabang')->on('sparepart_cabangs');
            $table->foreign('id_pengadaan_fk')->references('id_pengadaan')->on('pengadaan_spareparts');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detil_pengadaan_spareparts');
    }
}
