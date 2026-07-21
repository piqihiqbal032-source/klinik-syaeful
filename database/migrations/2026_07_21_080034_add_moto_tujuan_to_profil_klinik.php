<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('profil_klinik', function (Blueprint $table) {
            $table->text('moto')->nullable()->after('sejarah_singkat');
            $table->text('tujuan')->nullable()->after('moto');
        });
    }

    public function down()
    {
        Schema::table('profil_klinik', function (Blueprint $table) {
            $table->dropColumn(['moto', 'tujuan']);
        });
    }
};