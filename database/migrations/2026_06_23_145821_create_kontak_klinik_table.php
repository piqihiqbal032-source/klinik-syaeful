<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kontak_klinik', function (Blueprint $table) {
            $table->id('id_kontak');
            $table->text('alamat_lengkap');
            $table->string('nomor_telepon', 20);
            $table->string('email', 100);
            $table->string('media_sosial', 255)->nullable();
            $table->string('link_peta', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kontak_klinik');
    }
};