<?php

namespace App\Enums;

enum PublikasiStatus: int implements EnumText 
{
    use EnumArray;

    case Published                 = 1;
    case Unpublished               = 0;

    public function text(): string {
        return match($this) {
            self::Published                 => 'Sudah Publikasi',
            self::Unpublished               => 'Belum Publikasi',
        };
    }

    public function color(): string {
        return match($this) {
            self::Published                 => 'green',
            self::Unpublished               => 'red',
        };
    }
}