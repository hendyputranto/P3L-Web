<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSparepartCabangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sparepart_cabangs', function (Blueprint $table) {
            $table->increments('id_sparepartCabang');
            $table->float('hargaBeli_sparepart');
            $table->float('hargaJual_sparepart');
            $table->string('letak_sparepart',11);
            $table->integer('stokMin_sparepart');
            $table->integer('stokSisa_sparepart');
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
        Schema::dropIfExists('sparepart_cabangs');
    }
}
