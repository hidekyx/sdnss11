<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MataPelajaran extends Model
{
    use SoftDeletes;

    protected $table = 'mata_pelajaran';

    protected $fillable = [
        'nama',
    ];

    public function guru()
    {
        return $this->belongsToMany(User::class, 'guru_mata_pelajaran', 'mata_pelajaran_id', 'guru_id')
                    ->withPivot(['tahun_ajaran'])
                    ->withTimestamps();
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'kelas_mata_pelajaran', 'mata_pelajaran_id', 'kelas_id')
                    ->withPivot(['tahun_ajaran'])
                    ->withTimestamps();
    }
}
