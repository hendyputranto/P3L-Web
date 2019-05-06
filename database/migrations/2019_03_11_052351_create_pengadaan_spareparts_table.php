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
            $table->unsignedInteger('id_supplier_fk');
            //$table->unsignedInteger('id_sparepartCabang_fk');
            $table->string('statusCetak_pengadaan');
            $table->string('status_pengadaan');
            $table->float('totalHarga_pengadaan');
            $table->date('tgl_pengadaan');
            $table->date('tgl_barangDatang');
             //$table->integer('satuan_pengadaan');
            //$table->integer('totalBarang_datang');
            
            $table->timestamps();

            $table->foreign('id_supplier_fk')->references('id_supplier')->on('suppliers');
            //$table->foreign('id_sparepartCabang_fk')->references('id_sparepartCabang')->on('sparepart_cabangs');
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
