<?php

namespace App\Enums;

enum Role: int implements EnumText 
{
    use EnumArray;

    case Admin = 1;
    case KepalaSekolah = 2;
    case TataUsaha = 3;
    case WaliKelas = 4;
    case GuruPelajaran = 5;
    case PenjagaSekolah = 6;

    public function text(): string {
        return match($this) {
            self::Admin => 'Admin',
            self::KepalaSekolah => 'Kepala Sekolah',
            self::TataUsaha => 'Tata Usaha',
            self::WaliKelas => 'Wali Kelas',
            self::GuruPelajaran => 'Guru Pelajaran',
            self::PenjagaSekolah => 'Penjaga Sekolah',
        };
    }
}