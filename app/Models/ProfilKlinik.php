<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilKlinik extends Model
{
    protected $table = 'profil_klinik';
    protected $primaryKey = 'id_profil';
    public $timestamps = false;

    protected $fillable = [
        'sejarah_singkat',
        'moto',       
        'tujuan',     
        'visi',
        'misi',
        'struktur_organisasi'
    ];
// Otomatis ubah JSON ke Array dan sebaliknya
    protected $casts = [
        'struktur_organisasi' => 'array',
    ];
}