<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('layanan_medis', function (Blueprint $table) {
            // Cek dan tambah kolom jika belum ada
            if (!Schema::hasColumn('layanan_medis', 'slug')) {
                $table->string('slug')->nullable()->unique()->after('nama_layanan');
            }
            
            if (!Schema::hasColumn('layanan_medis', 'deskripsi_singkat')) {
                $table->text('deskripsi_singkat')->nullable()->after('deskripsi');
            }
            
            if (!Schema::hasColumn('layanan_medis', 'deskripsi_lengkap')) {
                $table->longText('deskripsi_lengkap')->nullable()->after('deskripsi_singkat');
            }
            
            if (!Schema::hasColumn('layanan_medis', 'persyaratan')) {
                $table->text('persyaratan')->nullable()->after('deskripsi_lengkap');
            }
            
            if (!Schema::hasColumn('layanan_medis', 'status_bpjs')) {
                $table->enum('status_bpjs', ['BPJS', 'Umum', 'BPJS & Umum'])->default('BPJS & Umum')->after('status_aktif');
            }
            
            if (!Schema::hasColumn('layanan_medis', 'foto')) {
                $table->string('foto')->nullable()->after('status_bpjs');
            }
        });
    }

    public function down(): void
    {
        Schema::table('layanan_medis', function (Blueprint $table) {
            $columns = ['slug', 'deskripsi_singkat', 'deskripsi_lengkap', 'persyaratan', 'status_bpjs', 'foto'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('layanan_medis', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};