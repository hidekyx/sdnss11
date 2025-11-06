<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Infografis extends Model
{
    protected $table = "infografis";
    
    protected $fillable = [
        'title',
        'kategori',
        'penanggung_jawab_id',
        'img',
        'deskripsi_singkat',
        'is_published',
        'published_at',
    ];

    public function penanggungJawab()
    {
        return $this->belongsTo(User::class, 'penanggung_jawab_id', 'id');
    }
}