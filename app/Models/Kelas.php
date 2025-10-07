<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use SoftDeletes;
    
    protected $table = "kelas";
    
    protected $fillable = [
        'nama',
        'tingkat',
    ];

    public function siswa()
    {
        return $this->belongsToMany(Siswa::class, 'kelas_siswa', 'kelas_id', 'siswa_id')
                    ->withPivot(['tahun_ajaran', 'tanggal_mulai', 'tanggal_selesai', 'status'])
                    ->withTimestamps();
    }

    public function kelasSiswa()
    {
        return $this->hasMany(KelasSiswa::class, 'kelas_id');
    }

    public function kelasGuru()
    {
        return $this->hasMany(KelasGuru::class, 'kelas_id');
    }

    public function guru()
    {
        return $this->belongsToMany(User::class, 'kelas_guru', 'kelas_id', 'guru_id')
                    ->withPivot(['tahun_ajaran', 'tanggal_mulai', 'tanggal_selesai', 'status', 'keterangan'])
                    ->withTimestamps();
    }
}