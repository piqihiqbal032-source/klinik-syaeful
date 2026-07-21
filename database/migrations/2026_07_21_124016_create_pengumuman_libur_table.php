<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pengumuman_libur', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dokter_id');
            $table->date('tanggal');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Foreign key ke tabel jadwal_dokter
            $table->foreign('dokter_id')
                  ->references('id_jadwal')
                  ->on('jadwal_dokter')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengumuman_libur');
    }
};