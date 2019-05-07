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
            $table->unsignedInteger('id_cabang_fk');
            $table->string('kode_sparepart_fk',25);
            $table->float('hargaBeli_sparepart');
            $table->float('hargaJual_sparepart');
            $table->string('letak_sparepart',12);
            $table->integer('stokMin_sparepart');
            $table->integer('stokSisa_sparepart');
            $table->timestamps();
            
            $table->foreign('id_cabang_fk')->references('id_cabang')->on('cabangs');
            $table->foreign('kode_sparepart_fk')->references('kode_sparepart')->on('spareparts');
            
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
