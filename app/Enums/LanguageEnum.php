<?php

namespace App\Enums;

enum LanguageEnum: string
{
    case ENGLISH = 'en';
    case FRENCH = 'fr';
    case SPANISH = 'es';
    case GERMAN = 'de';


    public function getDescription(): string
    {
        return match ($this) {
            self::ENGLISH => 'Inglese',
            self::FRENCH => 'Francese',
            self::SPANISH => 'Spagnolo',
            self::GERMAN => 'Tedesco',
        };
    }

}
