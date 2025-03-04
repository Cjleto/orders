<?php

namespace App\Enums;

enum OrderStatus: string
{
    case IN_ELABORAZIONE = 'in elaborazione';
    case SPEDITO = 'spedito';
    case CONSEGNATO = 'consegnato';
}
