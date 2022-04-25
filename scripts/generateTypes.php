<?php

declare(strict_types=1);

use GusALN\TelegramBotApi\CodeGeneration\Definitions\ObjectTypeDefinition;
use const GusALN\TelegramBotApi\CodeGeneration\METHODS_CACHE;
use GusALN\TelegramBotApi\CodeGeneration\TypeImporter;
use GusALN\TelegramBotApi\CodeGeneration\TypeObjectCodeGeneratorFactory;
use const GusALN\TelegramBotApi\CodeGeneration\TYPES_CACHE;

require __DIR__.'/../vendor/autoload.php';

if (file_exists(TYPES_CACHE)) {
    $types = array_map(
        fn ($t) => ObjectTypeDefinition::fromArray($t),
        json_decode(file_get_contents(TYPES_CACHE), true, flags: JSON_THROW_ON_ERROR)
    );
} else {
    [$types, $methods] = TypeImporter::getTypeDefinitions();

    file_put_contents(TYPES_CACHE, json_encode($types));
    file_put_contents(METHODS_CACHE, json_encode($methods));
}

foreach ($types as $typeDefinition) {
    TypeObjectCodeGeneratorFactory::get()
        ->create($typeDefinition)
        ->generate();
}
