<?php

declare(strict_types=1);

use GusALN\TelegramBotApi\CodeGeneration\BotApiCodeGenerator;
use GusALN\TelegramBotApi\CodeGeneration\Definitions\MethodTypeDefinition;
use GusALN\TelegramBotApi\CodeGeneration\Definitions\ObjectTypeDefinition;
use const GusALN\TelegramBotApi\CodeGeneration\METHODS_CACHE;
use GusALN\TelegramBotApi\CodeGeneration\TypeImporter;
use const GusALN\TelegramBotApi\CodeGeneration\TYPES_CACHE;

require __DIR__.'/../vendor/autoload.php';

if (file_exists(TYPES_CACHE) && file_exists(METHODS_CACHE)) {
    $types = array_map(
        fn ($t) => ObjectTypeDefinition::fromArray($t),
        json_decode(file_get_contents(TYPES_CACHE), true, flags: JSON_THROW_ON_ERROR)
    );
    $methods = array_map(
        fn ($t) => MethodTypeDefinition::fromArray($t),
        json_decode(file_get_contents(METHODS_CACHE), true, flags: JSON_THROW_ON_ERROR)
    );
} else {
    [$types, $methods] = TypeImporter::getTypeDefinitions();

    file_put_contents(TYPES_CACHE, json_encode($types));
    file_put_contents(METHODS_CACHE, json_encode($methods));
}

(new BotApiCodeGenerator($types, $methods))->generate();
