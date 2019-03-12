<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSparepartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spareparts', function (Blueprint $table) {
            $table->increments('id_sparepart');
            $table->string('nama_sparepart',30);
            $table->string('merk_sparepart',30);
            $table->string('tipe_sparepart',30);
            $table->string('kode_sparepart',20);
            //$table->string('kode_sparepart',25)->index();
            $table->string('gambar_sparepart',255);
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
        Schema::dropIfExists('spareparts');
    }
}
