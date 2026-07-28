<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LayananMedis extends Model 
{
    use HasFactory;

    protected $table = 'layanan_medis';
    protected $primaryKey = 'id_layanan';
    
    protected $fillable = [
        'nama_layanan',
        'slug',
        'deskripsi',
        'deskripsi_singkat',
        'deskripsi_lengkap',
        'persyaratan',
        'gambar',
        'foto',
        'status_aktif',
        'status_bpjs',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($layanan) {
            if (empty($layanan->slug)) {
                $layanan->slug = Str::slug($layanan->nama_layanan);
            }
        });

        static::updating(function ($layanan) {
            if ($layanan->isDirty('nama_layanan')) {
                $layanan->slug = Str::slug($layanan->nama_layanan);
            }
        });
    }

    // Accessor untuk deskripsi_singkat (fallback)
    public function getDeskripsiSingkatAttribute($value)
    {
        return $value ?? Str::limit($this->deskripsi, 100);
    }

    // Accessor untuk deskripsi_lengkap (fallback)
    public function getDeskripsiLengkapAttribute($value)
    {
        return $value ?? $this->deskripsi;
    }

    // Accessor untuk foto (fallback ke gambar)
    public function getFotoAttribute($value)
    {
        return $value ?? $this->gambar;
    }
}