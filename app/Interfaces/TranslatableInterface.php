<?php

namespace App\Interfaces;

interface TranslatableInterface
{
    public function getTranslationPath(): string;

    public function getTranslatedValue(string $field, string $locale): string;

    public function setTranslatedValue(array $translations, string $locale): void;
}
