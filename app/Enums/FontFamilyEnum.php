<?php

namespace App\Enums;

enum FontFamilyEnum: string
{
        // Sans-serif Fonts
    case ARIAL = 'Arial';
    case HELVETICA = 'Helvetica';
    case ROBOTO = 'Roboto';
    case ROBOTO_FLEX = 'Roboto Flex';
    case TAHOMA = 'Tahoma';
    case VERDANA = 'Verdana';
    case TREBUCHET_MS = 'Trebuchet MS';
    case MONTSERRAT = 'Montserrat';

        // Serif Fonts
    case TIMES_NEW_ROMAN = 'Times New Roman';
    case GEORGIA = 'Georgia';

        // Monospace Fonts
    case COURIER_NEW = 'Courier New';
    case LUCIDA_CONSOLE = 'Lucida Console';

        // Handwriting Fonts
    case COMIC_SANS_MS = 'Comic Sans MS';
    case DANCING_SCRIPT = 'Dancing Script';
    case GREAT_VIBES = 'Great Vibes';
    case KALAM = 'Kalam';
    case NOTHING_YOU_COULD_DO = 'Nothing You Could Do';
    case PARISIENNE = 'Parisienne';
    case SHADOWS_INTO_LIGHT = 'Shadows Into Light';
    case PROTEST_STRIKE = 'Protest Strike';
    case WALTER_TURNCOAT = 'Walter Turncoat';
    case EPHESIS = 'Ephesis';
    case GRAND_HOTEL = 'Grand Hotel';

        // Display Fonts
    case IMPACT = 'Impact';
    case PLAYWRITE_GB_S = 'Playwrite GB S';
    case GRADUATE = 'Graduate';
    case NUNITO = 'Nunito';
    case JETBRAINS_MONO = 'JetBrains Mono';
    case POPPINS = 'Poppins';

    // Method to get the group for each font
    public function getGroup(): string
    {
        return match ($this) {
            self::ARIAL, self::HELVETICA, self::ROBOTO, self::ROBOTO_FLEX,
            self::TAHOMA, self::VERDANA, self::TREBUCHET_MS, self::MONTSERRAT => 'Sans-serif',
            self::TIMES_NEW_ROMAN, self::GEORGIA => 'Serif',
            self::COURIER_NEW, self::LUCIDA_CONSOLE => 'Monospace',
            self::COMIC_SANS_MS, self::DANCING_SCRIPT, self::GREAT_VIBES,
            self::KALAM, self::NOTHING_YOU_COULD_DO, self::PARISIENNE,
            self::SHADOWS_INTO_LIGHT, self::PROTEST_STRIKE, self::WALTER_TURNCOAT,
            self::EPHESIS, self::GRAND_HOTEL => 'Handwriting',
            self::IMPACT, self::PLAYWRITE_GB_S, self::GRADUATE, self::NUNITO, self::JETBRAINS_MONO, self::POPPINS => 'Display',

        };
    }
}
