<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMotorKonsumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motor_konsumens', function (Blueprint $table) {
            $table->unsignedInteger('id_motor_fk');
            $table->unsignedInteger('id_konsumen_fk');
            $table->increments('id_motorKonsumen');
            $table->string('plat_motorKonsumen');
            $table->timestamps();

            $table->foreign('id_motor_fk')->references('id_motor')->on('Motor');
            $table->foreign('id_konsumen_fk')->references('id_konsumen')->on('Konsumen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('motor_konsumens');
    }
}
