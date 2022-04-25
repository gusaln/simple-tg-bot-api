<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\CodeGeneration;

use GusALN\TelegramBotApi\CodeGeneration\Definitions\ObjectTypeDefinition;
use GusALN\TelegramBotApi\CodeGeneration\Definitions\PropertyDefinition;
use GusALN\TelegramBotApi\CodeGeneration\Definitions\TypedDefinition;

abstract class TypeObjectCodeGenerator extends CodeGenerator
{
    protected ObjectTypeDefinition $definition;

    public function generate(): void
    {
        file_put_contents($this->getFilePath(), $this->generateFileContent());
    }

    final public static function getClassName(ObjectTypeDefinition $definition): string
    {
        return $definition->name;
    }

    final public static function getClassNamespace(): string
    {
        return 'GusALN\TelegramBotApi\Types';
    }

    final public static function getFqn(string $className): string
    {
        return self::getClassNamespace().'\\'.$className;
    }

    final public function getFilePath(): string
    {
        return __DIR__.'/../../src/Types/'.self::getClassName($this->definition).'.php';
    }

    protected function generateUsingStatements(): string
    {
        $usingStatements = [
            'use JsonSerializable;',
        ];

        foreach ($this->definition->properties as $propertyDefinition) {
            foreach ($propertyDefinition->nonPrimitiveTypes as $type) {
                if ($this->definition->name != $type) {
                    $usingStatements[] = 'use '.self::getFqn($type).';';
                }
            }
        }

        sort($usingStatements);

        return implode("\n", array_unique($usingStatements))."\n";
    }

    protected function generateConstructorMethod(): string
    {
        return $this->generateConstructorMethodForProperties($this->definition->properties);
    }

    protected function generateFromMethodArgument(string $padding, string $key, TypedDefinition $definition)
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

    /**
     * @param PropertyDefinition[] $properties
     */
    protected function generateConstructorMethodForProperties(array $properties): string
    {
        if (empty($properties)) {
            $lines = [
                '    public function __construct()',
                '    {',
                '    }',
            ];

            return implode("\n", $lines);
        }

        $constructorDocstring = [
            '    /**',
        ];

        $constructorSignature = [
            '    public function __construct(',
        ];

        $padding = '        ';
        foreach ($properties as $propertyDefinition) {
            $propertyDefaultValue = $propertyDefinition->isNullable() ? ' = null' : '';
            $propertyName = camel_case($propertyDefinition->name);
            $propertyTypeHint = "{$propertyDefinition->typeHint()} ";

            $propertyDocstring = '     * @param ';
            $propertyDefaultValue = '';

            if ($propertyDefinition->isNullable()) {
                $propertyDefaultValue = ' = null';
            }

            $propertyDocstring .= "{$propertyDefinition->docstringTypeHint()} ";

            $propertyDocstring .= "\${$propertyName} ";
            $propertyDocstring .= $propertyDefinition->description;

            $constructorDocstring[] = $propertyDocstring;
            $constructorSignature[] = "{$padding}public {$propertyTypeHint}\${$propertyName}{$propertyDefaultValue},";
        }

        $constructorDocstring[] = '     */';

        $constructorSignature[] = '    ) {';
        $constructorSignature[] = '    }';

        return implode("\n", $constructorDocstring)."\n".implode("\n", $constructorSignature);
    }

    protected function generateJsonSerializeMethod(): string
    {
        if (empty($this->definition->properties)) {
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

        foreach ($this->definition->properties as $propertyDefinition) {
            $key = $propertyDefinition->name;
            $property = camel_case($propertyDefinition->name);

            $jsonSerializeMethod[] = "{$padding}'{$key}' => \$this->{$property},";
        }

        $jsonSerializeMethod[] = '        ]);';
        $jsonSerializeMethod[] = '    }';

        return implode("\n", $jsonSerializeMethod);
    }

    protected function generateDocstring(): string
    {
        $docString = ['/**'];

        foreach ($this->definition->description as $descLine) {
            foreach (explode("\n", $descLine) as $line) {
                $docString[] = rtrim(" * {$line}");
            }
        }

        $docString[] = ' */';

        return implode("\n", $docString);
    }
}
