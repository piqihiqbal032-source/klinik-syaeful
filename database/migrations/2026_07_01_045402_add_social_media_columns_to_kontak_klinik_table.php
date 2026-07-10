<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('kontak_klinik', function (Blueprint $table) {
            $table->string('instagram')->nullable()->after('email');
            $table->string('facebook')->nullable()->after('instagram');
            $table->string('twitter')->nullable()->after('facebook');
            $table->string('youtube')->nullable()->after('twitter');
        });
    }

    public function down()
    {
        Schema::table('kontak_klinik', function (Blueprint $table) {
            $table->dropColumn(['instagram', 'facebook', 'twitter', 'youtube']);
        });
    }
};