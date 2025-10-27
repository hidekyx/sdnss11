<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ekstrakulikuler extends Model
{
    protected $table = "ekstrakulikuler";
    
    protected $fillable = [
        'nama',
        'kategori',
        'penanggung_jawab_id',
        'deskripsi',
        'deskripsi_singkat',
    ];

    public function penanggungJawab()
    {
        return $this->belongsTo(User::class, 'penanggung_jawab_id', 'id');
    }

    public function ekstrakulikulerSiswa()
    {
        return $this->hasMany(EkstrakulikulerSiswa::class, 'ekstrakulikuler_id', 'id');
    }

    public function ekstrakulikulerGaleri()
    {
        return $this->hasMany(EkstrakulikulerGaleri::class, 'ekstrakulikuler_id', 'id')->orderByDesc('created_at');
    }
}