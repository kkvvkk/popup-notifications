<?php

namespace Layer\Infrastructure\Translation;

abstract class TranslationProvider
{
    abstract public function translateForCurrentLanguage(string $key, string $domain): string;
}
