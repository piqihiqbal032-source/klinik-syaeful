<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profil_klinik', function (Blueprint $table) {
            $table->id('id_profil');
            $table->text('sejarah_singkat');
            $table->text('visi_misi');
            $table->text('struktur_organisasi')->nullable();
            $table->string('nomor_izin', 50);
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil_klinik');
    }
};