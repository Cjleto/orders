<?php

namespace App\Services;

use App\Interfaces\TranslatorInterface;

class YandexTranslator implements TranslatorInterface
{
    public function translate(string $source, string $target, string $text): string
    {
        $res = 'Yandex: ' . $text;

        $this->logRequest($source, $target, $text, $res);

        return $res;
    }

    public function logRequest(string $source, string $target, string $text, string $res): void
    {
        info("YandexTranslator: translated $text from $source to $target: $res");
        activity()
            ->event('translation_request')
            ->withProperties(['source' => $source, 'target' => $target, 'text' => $text, 'res' => $res])
            ->log('YandexTranslator: translation request');
    }
}
