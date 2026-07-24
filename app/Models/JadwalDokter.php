<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalDokter extends Model
{
    use HasFactory;

    protected $table = 'jadwal_dokter';
    protected $primaryKey = 'id_jadwal'; // Sesuaikan jika primary key Anda 'id'

    protected $fillable = [
        'nama_dokter',
        'hari_praktik',
        'jam_mulai',
        'jam_selesai',
        'catatan',
    ];

    protected $casts = [
        'hari_praktik' => 'array',
    ];
}