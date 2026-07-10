<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontakKlinik extends Model
{
    protected $table = 'kontak_klinik';
    protected $primaryKey = 'id_kontak';
    
   protected $fillable = [
    'alamat_lengkap',
    'nomor_telepon',
    'email',
    'instagram',
    'facebook',
    'twitter',
    'youtube',
    'link_peta'
    ];
}