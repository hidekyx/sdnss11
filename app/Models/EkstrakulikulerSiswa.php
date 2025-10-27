<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EkstrakulikulerSiswa extends Model
{    
    protected $table = "ekstrakulikuler_siswa";
    
    protected $fillable = [
        'ekstrakulikuler_id',
        'siswa_id',
        'tahun_ajaran_id',
        'status',
    ];

    public function ekstrakulikuler()
    {
        return $this->belongsTo(Ekstrakulikuler::class, 'ekstrakulikuler_id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function tahun_ajaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id');
    }
}