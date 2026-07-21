<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalDokter extends Model
{
    protected $table = 'jadwal_dokter';
    protected $primaryKey = 'id_jadwal';

    protected $fillable = [
        'nama_dokter',
        'hari_praktik',
        'jam_mulai',
        'jam_selesai'
    ];

    protected $casts = [
        'hari_praktik' => 'array' 
    ];
}