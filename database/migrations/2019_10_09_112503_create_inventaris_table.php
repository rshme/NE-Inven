<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventarisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventaris', function (Blueprint $table) {
            $table->increments('id_inventaris');
            $table->unsignedInteger('id_jenis');
            $table->foreign('id_jenis')->references('id_jenis')->on('jenis')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('id_ruang');
            $table->foreign('id_ruang')->references('id_ruang')->on('ruang')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('id_petugas');
            $table->foreign('id_petugas')->references('id_petugas')->on('petugas')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama');
            $table->enum('kondisi', ['baik', 'rusak_ringan', 'rusak_parah']);
            $table->text('keterangan');
            $table->integer('jumlah');
            $table->string('kode_inventaris');
            $table->date('tanggal_register');
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
        Schema::dropIfExists('inventaris');
    }
}
