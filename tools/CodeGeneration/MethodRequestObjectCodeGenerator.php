<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\CodeGeneration;

use GusALN\TelegramBotApi\CodeGeneration\Definitions\MethodTypeDefinition;

class MethodRequestObjectCodeGenerator extends CodeGenerator
{
    public function __construct(private MethodTypeDefinition $definition)
    {
    }

    public static function getClassName(MethodTypeDefinition $definition): string
    {
        return ucfirst($definition->name).'Request';
    }

    public static function getClassNamespace(): string
    {
        return 'GusALN\TelegramBotApi\MethodRequests';
    }

    public static function getFqn(string $className): string
    {
        return self::getClassNamespace().'\\'.$className;
    }

    public function getFilePath(): string
    {
        return __DIR__.'/../../src/MethodRequests/'.self::getClassName($this->definition).'.php';
    }

    public function generateFileContent(): string
    {
        $docString = $this->generateDocstring();
        $className = self::getClassName($this->definition);
        $namespace = self::getClassNamespace();

        $usingStatements = $this->generateUsingStatements();

        $constructor = $this->generateConstructorMethod();
        $fromPayloadMethod = $this->generateFromPayloadMethod();
        $jsonSerializeMethod = $this->generateJsonSerializeMethod();

        return <<<TXT
            <?php

            declare(strict_types=1);

            namespace {$namespace};

            {$usingStatements}
            {$docString}
            class {$className} extends MethodRequest
            {
            {$constructor}

            {$fromPayloadMethod}

            {$jsonSerializeMethod}

                public function method(): string
                {
                    return '{$this->definition->name}';
                }
            }
            TXT;
    }

    private function generateUsingStatements(): string
    {
        $usingStatements = [
            "use GusALN\TelegramBotApi\Contracts\MethodRequest;",
        ];

        foreach ($this->definition->parameters as $parameterDefinition) {
            foreach ($parameterDefinition->nonPrimitiveTypes as $type) {
                $usingStatements[] = 'use '.TypeObjectCodeGenerator::getFqn($type).';';
            }
        }

        sort($usingStatements);

        return implode("\n", array_unique($usingStatements))."\n";
    }

    private function generateConstructorMethod(): string
    {
        if (empty($this->definition->parameters)) {
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

        foreach ($this->definition->parameters as $parameterDefinition) {
            $propertyDefaultValue = ! $parameterDefinition->isRequired ? ' = null' : '';
            $propertyName = camel_case($parameterDefinition->name);
            $propertyTypeHint = "{$parameterDefinition->typeHint()} ";

            $propertyDocstring = '     * @param ';
            $propertyDefaultValue = '';

            if (! $parameterDefinition->isRequired) {
                $propertyDefaultValue = ' = null';
            }

            $propertyDocstring .= "{$parameterDefinition->docstringTypeHint()} ";

            $propertyDocstring .= "\${$propertyName} ";
            $propertyDocstring .= $parameterDefinition->description;

            $constructorDocstring[] = $propertyDocstring;
            $constructorSignature[] = "{$padding}public {$propertyTypeHint}\${$propertyName}{$propertyDefaultValue},";
        }

        $constructorDocstring[] = '    */';

        $constructorSignature[] = '    ) {';
        $constructorSignature[] = '    }';

        return implode("\n", $constructorDocstring)."\n".implode("\n", $constructorSignature);
    }

    private function generateJsonSerializeMethod(): string
    {
        if (empty($this->definition->parameters)) {
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
        ];

        $padding = '            ';

        foreach ($this->definition->parameters as $parameterDefinition) {
            $key = $parameterDefinition->name;
            $property = camel_case($parameterDefinition->name);

            $jsonSerializeMethod[] = "{$padding}'{$key}' => \$this->{$property},";
        }

        $jsonSerializeMethod[] = '        ]);';
        $jsonSerializeMethod[] = '    }';

        return implode("\n", $jsonSerializeMethod);
    }

    private function generateFromPayloadMethod(): string
    {
        if (empty($this->definition->parameters)) {
            $lines = [
                '    public static function fromPayload(array $payload): static',
                '    {',
                '        return new self();',
                '    }',
            ];

            return implode("\n", $lines)."\n";
        }

        $fromPayloadMethod = [
            '    public static function fromPayload(array $payload): static',
            '    {',
            '        return new self(',
        ];

        $padding = '            ';

        foreach ($this->definition->parameters as $parameterDefinition) {
            $key = $parameterDefinition->name;
            $fromPayloadMethod[] = "{$padding}\$payload['{$key}'],";
        }

        $fromPayloadMethod[] = '        );';
        $fromPayloadMethod[] = '    }';

        return implode("\n", $fromPayloadMethod);
    }

    private function generateDocstring(): string
    {
        $docString = ['/**'];

        foreach ($this->definition->description as $descLine) {
            foreach (explode("\n", $descLine) as $line) {
                $docString[] = " * {$line}";
            }
        }

        $docString[] = ' */';

        return implode("\n", $docString);
    }
}
