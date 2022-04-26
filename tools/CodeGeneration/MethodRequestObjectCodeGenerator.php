<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\CodeGeneration;

use GusALN\TelegramBotApi\CodeGeneration\Concerns\GeneratesFromPayloadMethod;
use GusALN\TelegramBotApi\CodeGeneration\Concerns\GeneratesJsonSerializeMethod;
use GusALN\TelegramBotApi\CodeGeneration\Definitions\MethodTypeDefinition;

/**
 * Generates classes for the MethodRequest that contain the method's parameters.
 */
class MethodRequestObjectCodeGenerator extends CodeGenerator
{
    use GeneratesFromPayloadMethod;
    use GeneratesJsonSerializeMethod;

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

        $content = $this->mergeBlocks($this->generateClassBodyBlocks());

        return <<<TXT
            <?php

            declare(strict_types=1);

            namespace {$namespace};

            {$usingStatements}
            {$docString}
            class {$className} extends MethodRequest
            {
            {$content}
            }
            TXT;
    }

    protected function generateClassBodyBlocks(): array
    {
        return [
            $this->generateConstructorMethod(),
            $this->generateFromPayloadMethod(),
            $this->generateJsonSerializeMethod(),
            $this->generateMethods(),
        ];
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

    protected function getPropertiesDeserializableFromPayload(): array
    {
        return $this->definition->parameters;
    }

    protected function getJsonSerializableProperties(): array
    {
        return $this->definition->parameters;
    }

    private function generateMethods()
    {
        return <<<TXT
                public function method(): string
                {
                    return '{$this->definition->name}';
                }
            TXT;
    }
}
