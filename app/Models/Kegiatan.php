<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatan';
    
    protected $fillable = [
        'judul',
        'instagram_url',
        'status',
    ];

    public function getEmbedUrlAttribute()
    {
        if (strpos($this->instagram_url, 'instagram.com/p/') !== false) {
            preg_match('/instagram\.com\/p\/([A-Za-z0-9_-]+)/', $this->instagram_url, $matches);
            if (isset($matches[1])) {
                return 'https://www.instagram.com/p/' . $matches[1] . '/embed';
            }
        }
        return $this->instagram_url;
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}