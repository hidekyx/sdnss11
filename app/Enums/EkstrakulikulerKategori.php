<?php

namespace App\Enums;

enum EkstrakulikulerKategori: int implements EnumText 
{
    use EnumArray;

    case Kedisiplinan = 1;
    case Kesenian = 2;
    case Keagamaan = 3;

    public function text(): string {
        return match($this) {
            self::Kedisiplinan => 'Kedisiplinan',
            self::Kesenian => 'Kesenian',
            self::Keagamaan => 'Keagamaan',
        };
    }
    public static function listKategori(): array
    {
        return [
            1 => 'Kedisiplinan',
            2 => 'Kesenian',
            3 => 'Keagamaan',
        ];
    }
}