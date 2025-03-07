<?php

namespace App\Enums;

enum OrderStatus: string
{
    case IN_ELABORAZIONE = 'in elaborazione';
    case SPEDITO = 'spedito';
    case CONSEGNATO = 'consegnato';

    public static function all(): array
    {
        return [
            self::IN_ELABORAZIONE,
            self::SPEDITO,
            self::CONSEGNATO,
        ];
    }

    public static function toArray(): array
    {
        return [
            self::IN_ELABORAZIONE => 'In elaborazione',
            self::SPEDITO => 'Spedito',
            self::CONSEGNATO => 'Consegnato',
        ];
    }
}
