<?php

namespace App\Enums;

enum PublikasiKategori: int implements EnumText 
{
    use EnumArray;

    case Pengumuman = 1;
    case Perlombaan = 2;
    case Kegiatan = 3;
    case Umum = 4;

    public function text(): string {
        return match($this) {
            self::Pengumuman => 'Pengumuman',
            self::Perlombaan => 'Perlombaan',
            self::Kegiatan => 'Kegiatan',
            self::Umum => 'Umum',
        };
    }

    public function color(): string {
        return match($this) {
            self::Pengumuman => 'cyan',
            self::Perlombaan => 'cyan',
            self::Kegiatan => 'cyan',
            self::Umum => 'cyan',
        };
    }

    public static function listKategori(): array
    {
        return [
            1 => 'Pengumuman',
            2 => 'Perlombaan',
            3 => 'Kegiatan',
            4 => 'Umum',
        ];
    }
}