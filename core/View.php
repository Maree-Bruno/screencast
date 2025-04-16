<?php

namespace Tecgdcs;

use eftec\bladeone\BladeOne;

class View extends BladeOne
{
    public const string VIEWS_DIR = __DIR__.'/../resources/views';
    public const string CACHE_DIR = __DIR__.'/../storage/cache';

    public static function make(string $view, array $data)
    {
        echo (new self(
            self::VIEWS_DIR,
            self::CACHE_DIR,
            BladeOne::MODE_DEBUG))
            ->run($view, $data);
    }
}