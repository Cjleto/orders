<?php

namespace App\Services;

use App\Interfaces\TranslatorInterface;
use Context;
use Stichoza\GoogleTranslate\GoogleTranslate;

class GoogleTranslator implements TranslatorInterface
{
    public function translate(string $source, string $target, string $text): string
    {

        if(app()->environment('testing') && Context::get('enable_translation') === false) {
            info('GoogleTranslator Context: Translation is disabled');
            return $text;
        }

        $res = (new GoogleTranslate())->preserveParameters()
            ->setOptions([
                'timeout' => 10,
            ])
            ->setSource($source)
            ->setTarget($target)
            ->translate($text);

            $this->logRequest($source, $target, $text, $res);

            return $res;
        }

        public function logRequest(string $source, string $target, string $text, string $res): void
        {
        info("GoogleTranslator: translated $text from $source to $target: $res");
        activity()
            ->event('translation_request')
            ->withProperties(['source' => $source, 'target' => $target, 'text' => $text, 'res' => $res])
            ->log('GoogleTranslator: translation request');
    }
}
