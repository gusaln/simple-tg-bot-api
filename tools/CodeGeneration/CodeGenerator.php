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

    /**
     * Generates the blocks of the class.
     *
     * @return array<int, string|null>
     */
    abstract protected function generateClassBodyBlocks(): array;

    /**
     * Stitches the blocks of a class together.
     *
     * If a block is null, it will be left out of the contents of the class.
     *
     * @param array<int, string|null> $block
     */
    protected function mergeBlocks(array $block): string
    {
        return implode("\n\n", array_filter($block));
    }
}
