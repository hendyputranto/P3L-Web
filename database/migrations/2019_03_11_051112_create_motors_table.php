<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMotorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motors', function (Blueprint $table) {
            $table->increments('id_motor');
            // $table->string('kode_sparepart_fk', 25);
            $table->string('merk_motor',15);
            $table->string('tipe_motor',30);
            $table->timestamps();

            // $table->foreign('kode_sparepart_fk')->references('kode_sparepart')->on('spareparts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('motors');
    }
}
