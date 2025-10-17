<?php

namespace App\Enums;

enum PublikasiStatus: int implements EnumText 
{
    use EnumArray;

    case Published                 = 1;
    case Unpublished               = 0;

    public function text(): string {
        return match($this) {
            self::Published                 => 'Published',
            self::Unpublished               => 'Unpublished',
        };
    }

    public function icon(): string {
        return match($this) {
            self::Published                 => '<i class="material-icons">&#xe5ca;</i>',
            self::Unpublished               => '<i class="material-icons">&#xe5cd;</i>',
        };
    }

    public function color(): string {
        return match($this) {
            self::Published                 => 'success',
            self::Unpublished               => 'danger',
        };
    }
}