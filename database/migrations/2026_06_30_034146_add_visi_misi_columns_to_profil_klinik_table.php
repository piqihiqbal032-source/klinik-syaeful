<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('profil_klinik', function (Blueprint $table) {
            // Tambah kolom visi dan misi
            $table->text('visi')->nullable()->after('sejarah_singkat');
            $table->text('misi')->nullable()->after('visi');
        });
    }

    public function down()
    {
        Schema::table('profil_klinik', function (Blueprint $table) {
            $table->dropColumn(['visi', 'misi']);
        });
    }
};