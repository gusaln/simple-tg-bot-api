<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\CodeGeneration;

abstract class CodeGenerator
{
    public const PRIMITIVE_TYPES = [
        'bool',
        'float',
        'int',
        'string',
        'array',
    ];

    public function generate(): void
    {
        file_put_contents($this->getFilePath(), $this->generateFileContent());
    }

    abstract public function getFilePath(): string;

    abstract public function generateFileContent(): string;

    public function isPrimitive(string $type = null): bool
    {
        return in_array($type, self::PRIMITIVE_TYPES);
    }
}
