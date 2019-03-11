<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengadaanSparepartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengadaan_spareparts', function (Blueprint $table) {
            $table->increments('id_pengadaan');
            $table->string('status_pengadaan');
            $table->integer('satuan_pengadaan');
            $table->float('totalHarga_pengadaan');
            $table->integer('totalBarang_datang');
            $table->date('tgl_pengadaan');
            $table->date('tgl_barangDatang');
            $table->string('statusCetak_pengadaan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengadaan_spareparts');
    }
}
