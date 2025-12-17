<?php

namespace App\Enums;

enum ProductVisibility: string
{
    case PUBLIC = 'public';
    case HIDDEN = 'hidden';

    public function label(): string
    {
        return match ($this) {
            self::PUBLIC => 'Public',
            self::HIDDEN => 'Hidden',
        };
    }
}
