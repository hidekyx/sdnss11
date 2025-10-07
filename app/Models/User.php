<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'role_id',
        'name',
        'email',
        'password',
        'nip',
        'nrk',
        'tempat_lahir',
        'tanggal_lahir',
        'avatar',
        'no_hp',
        'alamat',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function kelasGuru()
    {
        return $this->hasMany(KelasGuru::class, 'guru_id');
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'kelas_guru', 'guru_id', 'kelas_id')
                    ->withPivot(['tahun_ajaran', 'tanggal_mulai', 'tanggal_selesai', 'status', 'keterangan'])
                    ->withTimestamps();
    }
}
