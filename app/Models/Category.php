<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug'];

    // Nonaktifkan pencatatan waktu otomatis (created_at & updated_at)
    public $timestamps = false;

    // Menghubungkan ke tabel kegiatan
    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class, 'category_id');
    }
}