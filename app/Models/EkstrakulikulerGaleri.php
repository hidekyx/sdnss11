<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EkstrakulikulerGaleri extends Model
{
    use SoftDeletes;
    
    protected $table = "ekstrakulikuler_galeri";
    
    protected $fillable = [
        'ekstrakulikuler_id',
        'title',
        'img',
    ];

    public function ekstrakulikuler()
    {
        return $this->belongsTo(Ekstrakulikuler::class, 'ekstrakulikuler_id');
    }
}