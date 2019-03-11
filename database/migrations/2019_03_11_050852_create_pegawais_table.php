<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->increments('id_pegawai');
            $table->unsignedInteger('id_role_fk');
            $table->unsignedInteger('id_cabang_fk');
            $table->string('nama_pegawai',50);
            $table->string('alamat_pegawai',150);
            $table->string('noTelp_pegawai',15);
            $table->float('gaji_pegawai');
            $table->string('username_pegawai',15);
            $table->string('password_pegawai',15);
            $table->timestamps();

            $table->foreign('id_role_fk')->references('id_role')->on('roles');
            $table->foreign('id_cabang_fk')->references('id_cabang')->on('cabangs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawais');
    }
}
