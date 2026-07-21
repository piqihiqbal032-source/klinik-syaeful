<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengumumanLibur extends Model
{
    protected $table = 'pengumuman_libur';

    protected $fillable = [
        'dokter_id',
        'tanggal',
        'keterangan'
    ];

    // Relasi ke JadwalDokter
    public function dokter()
    {
        return $this->belongsTo(JadwalDokter::class, 'dokter_id', 'id_jadwal');
    }
}