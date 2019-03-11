<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMontirOnDutiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('montir__on_duties', function (Blueprint $table) {
            $table->increments('id_montirOnDuty');
            $table->unsignedInteger('id_pegawai_fk');
            $table->unsignedInteger('id_motorKonsumen_fk');
            $table->timestamps();

            $table->foreign('id_pegawai_fk')->references('id_pegawai')->on('pegawais');
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
        Schema::dropIfExists('montir__on_duties');
    }
}
