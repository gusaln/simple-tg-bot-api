<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\CodeGeneration\Concerns;

use GusALN\TelegramBotApi\CodeGeneration\Definitions\ParameterDefinition;
use GusALN\TelegramBotApi\CodeGeneration\Definitions\PropertyDefinition;
use GusALN\TelegramBotApi\CodeGeneration\Definitions\TypedDefinition;

/**
 * @mixin \GusALN\TelegramBotApi\CodeGeneration\CodeGenerator
 */
trait GeneratesFromPayloadMethod
{
    /**
     * Indicates the properties that can be taken from a payload array.
     *
     * @return (PropertyDefinition|ParameterDefinition)[]
     */
    abstract protected function getPropertiesDeserializableFromPayload(): array;

    /**
     * Generates a method that parses the object from a payload array.
     */
    protected function generateFromPayloadMethod(): string
    {
        $properties = $this->getPropertiesDeserializableFromPayload();

        if (empty($properties)) {
            $lines = [
                '    /** @phpstan-param array<string,mixed> $payload */',
                '    public static function fromPayload(array $payload): self',
                '    {',
                '        return new self();',
                '    }',
            ];

            return implode("\n", $lines);
        }

        $fromPayloadMethod = [
            '    /** @phpstan-param array<string,mixed> $payload */',
            '    public static function fromPayload(array $payload): self',
            '    {',
            '        return new self(',
        ];

        $padding = '            ';

        foreach ($properties as $definition) {
            $key = $definition->name;

            $fromPayloadMethod[] = $this->generateFromPayloadMethodArgument($padding, $key, $definition);
        }

        $fromPayloadMethod[] = '        );';
        $fromPayloadMethod[] = '    }';

        return implode("\n", $fromPayloadMethod);
    }

    protected function generateFromPayloadMethodArgument(string $padding, string $key, TypedDefinition $definition)
    {
        if ($definition->isUnion() || $this->isPrimitive($definition->singleType())) {
            return $definition->isNullable()
                ? "{$padding}\$payload['{$key}'] ?? null,"
                : "{$padding}\$payload['{$key}'],";
        }

        $objectClass = $definition->singleType();

        $objectMapping = $definition->isArray
            ? "array_map(fn(\$t) => {$objectClass}::fromPayload(\$t), \$payload['{$key}'])"
            : "{$objectClass}::fromPayload(\$payload['{$key}'])";

        return $definition->isNullable()
                ? "{$padding}isset(\$payload['{$key}']) ? {$objectMapping} : null,"
                : "{$padding}$objectMapping,";
    }
}
