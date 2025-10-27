<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ekstrakulikuler extends Model
{
    use SoftDeletes;
    
    protected $table = "ekstrakulikuler";
    
    protected $fillable = [
        'nama',
        'kategori',
        'penanggung_jawab_id',
        'deskripsi',
        'deskripsi_singkat',
    ];
}