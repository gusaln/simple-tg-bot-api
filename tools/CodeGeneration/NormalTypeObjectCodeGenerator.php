<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\CodeGeneration;

use GusALN\TelegramBotApi\CodeGeneration\Definitions\ObjectTypeDefinition;

class NormalTypeObjectCodeGenerator extends TypeObjectCodeGenerator
{
    public function __construct(protected ObjectTypeDefinition $definition)
    {
    }

    public function generate(): void
    {
        file_put_contents($this->getFilePath(), $this->generateFileContent());
    }

    public function generateFileContent(): string
    {
        $namespace = self::getClassNamespace();
        $className = self::getClassName($this->definition);

        $constructor = $this->generateConstructorMethod();

        return <<<TXT
            <?php

            declare(strict_types=1);

            namespace {$namespace};

            {$this->generateUsingStatements()}
            {$this->generateDocstring()}
            class {$className} implements JsonSerializable
            {
            {$constructor}

            {$this->generateFromPayloadMethod()}

            {$this->generateJsonSerializeMethod()}
            }
            TXT;
    }

    private function generateFromPayloadMethod(): string
    {
        if (empty($this->definition->properties)) {
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

        foreach ($this->definition->properties as $propertyDefinition) {
            $key = $propertyDefinition->name;

            $fromPayloadMethod[] = $this->generateFromMethodArgument($padding, $key, $propertyDefinition);
        }

        $fromPayloadMethod[] = '        );';
        $fromPayloadMethod[] = '    }';

        return implode("\n", $fromPayloadMethod);
    }
}
