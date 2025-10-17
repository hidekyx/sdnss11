<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KelasGuru extends Model
{
    use SoftDeletes;
    
    protected $table = "kelas_guru";
    
    protected $fillable = [
        'kelas_id',
        'guru_id',
        'tahun_ajaran_id',
        'status',
        'keterangan',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }
}