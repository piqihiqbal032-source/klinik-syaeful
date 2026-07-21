<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jadwal_dokter', function (Blueprint $table) {
            $table->id('id_jadwal');
            $table->string('nama_dokter', 100);
            $table->json('hari_praktik');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwal_dokter');
    }
};