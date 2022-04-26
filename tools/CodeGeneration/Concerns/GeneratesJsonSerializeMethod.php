<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\CodeGeneration\Concerns;

use function GusALN\TelegramBotApi\CodeGeneration\camel_case;
use GusALN\TelegramBotApi\CodeGeneration\Definitions\ParameterDefinition;
use GusALN\TelegramBotApi\CodeGeneration\Definitions\PropertyDefinition;

/**
 * @mixin \GusALN\TelegramBotApi\CodeGeneration\CodeGenerator
 */
trait GeneratesJsonSerializeMethod
{
    /**
     * Indicates the properties that are json serializable.
     *
     * @return (PropertyDefinition|ParameterDefinition)[]
     */
    abstract protected function getJsonSerializableProperties(): array;

    /**
     * Generates a method complies with the JsonSerializable interface.
     */
    protected function generateJsonSerializeMethod(): string
    {
        $properties = $this->getJsonSerializableProperties();

        if (empty($properties)) {
            $lines = [
                '    public function jsonSerialize(): mixed',
                '    {',
                '        return [];',
                '    }',
            ];

            return implode("\n", $lines);
        }

        $jsonSerializeMethod = [
            '    public function jsonSerialize(): mixed',
            '    {',
            '        return array_filter([',
            // '    }',
        ];

        $padding = '            ';

        foreach ($properties as $definition) {
            $key = $definition->name;
            $property = camel_case($definition->name);

            $jsonSerializeMethod[] = "{$padding}'{$key}' => \$this->{$property},";
        }

        $jsonSerializeMethod[] = '        ]);';
        $jsonSerializeMethod[] = '    }';

        return implode("\n", $jsonSerializeMethod);
    }
}
