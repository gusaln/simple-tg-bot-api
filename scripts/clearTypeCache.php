<?php

declare(strict_types=1);

use const GusALN\TelegramBotApi\CodeGeneration\METHODS_CACHE;
use const GusALN\TelegramBotApi\CodeGeneration\TYPES_CACHE;

require __DIR__.'/../vendor/autoload.php';

foreach ([TYPES_CACHE, METHODS_CACHE] as $file) {
    if (file_exists($file)) {
        unlink($file);
    }
}
