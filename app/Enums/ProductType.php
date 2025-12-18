<?php

namespace App\Enums;

enum ProductType: string
{
    case SIMPLE = '0';
    case CLASSIFIED = '1';

    public function label(): string
    {
        return match ($this) {
            self::SIMPLE => 'Simple',
            self::CLASSIFIED => 'Classified',
        };
    }
}
