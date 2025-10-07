<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use SoftDeletes;
    
    protected $table = "siswa";
    
    protected $fillable = [
        'nama',
        'nipd',
        'nisn',
        'nik',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'avatar',
        'no_hp',
        'agama',
        'alamat_detail',
        'alamat_rt',
        'alamat_rw',
        'alamat_dusun',
        'alamat_kelurahan',
        'alamat_kecamatan',
        'alamat_kode_pos',
    ];

    public function kelasSiswa()
    {
        return $this->hasMany(KelasSiswa::class, 'siswa_id');
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'kelas_siswa', 'siswa_id', 'kelas_id')
                    ->withPivot(['tahun_ajaran', 'tanggal_mulai', 'tanggal_selesai', 'status'])
                    ->withTimestamps();
    }
}