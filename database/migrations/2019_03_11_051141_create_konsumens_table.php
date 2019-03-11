<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKonsumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konsumens', function (Blueprint $table) {
            $table->increments('id_konsumen');
            $table->string('nama_konsumen',50);
            $table->string('noTelp_konsumen',15);
            $table->string('alamat_konsumen',150);
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
        Schema::dropIfExists('konsumens');
    }
}
