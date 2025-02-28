<?php

namespace App\Enums;

enum CompanyStatus: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case SUSPENDED = 'suspended';

    public static function all(): array
    {
        return [
            self::ACTIVE,
            self::INACTIVE,
            self::SUSPENDED,
        ];
    }
}
