<?php

namespace App\Enums;

enum ProductType: string
{
    case SIMPLE = 'simple';
    case CLASSIFIED = 'classified';

    public function label(): string
    {
        return match ($this) {
            self::SIMPLE => 'Simple',
            self::CLASSIFIED => 'Classified',
        };
    }
}
