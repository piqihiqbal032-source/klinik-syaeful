<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananMedis extends Model
{
    protected $table = 'layanan_medis';
    protected $primaryKey = 'id_layanan';
    
    protected $fillable = [
    'alamat_lengkap',
    'nomor_telepon',
    'email',
    'media_sosial',
    'link_peta'
    ];
}