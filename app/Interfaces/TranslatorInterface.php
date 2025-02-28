<?php

namespace App\Interfaces;

interface TranslatorInterface
{
    public function translate(string $source, string $target, string $text): string;
    public function logRequest(string $source, string $target, string $text, string $res): void;
}
