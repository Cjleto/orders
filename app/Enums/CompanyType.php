<?php

namespace App\Enums;

enum CompanyType: string
{
    case GENERICO = 'generico';
    case RISTORANTE = 'ristorante';
    case PIZZERIA =  'pizzeria';
    case PUB = 'pub';
    case ENOTECA = 'enoteca';
    case STABILIMENTO_BALNEARE = 'stabilimento_balneare';
    case BAR = 'bar';
    case OSTERIA = 'osteria';
    case FOCACCERIA = 'focacceria';
    case PASTICCERIA = 'pasticceria';
    case GELATERIA = 'gelateria';
    case HAMBURGERIA = 'hamburgeria';
}
