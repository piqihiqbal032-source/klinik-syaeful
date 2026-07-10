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
        'visi',
        'misi',
        'struktur_organisasi',
        'nomor_izin'
    ];
}