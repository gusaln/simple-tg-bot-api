<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\CodeGeneration;

use GusALN\TelegramBotApi\CodeGeneration\Definitions\ObjectTypeDefinition;
use InvalidArgumentException;

final class ChildTypeObjectCodeGenerator extends TypeObjectCodeGenerator
{
    public function __construct(protected ObjectTypeDefinition $definition)
    {
        if (! $this->definition->isChildType()) {
            $type = $this->definition->name;
            throw new InvalidArgumentException("Type {$type} is not an ChildType");
        }
    }

    public function generate(): void
    {
        file_put_contents($this->getFilePath(), $this->generateFileContent());
    }

    public function generateFileContent(): string
    {
        $namespace = self::getClassNamespace();
        $className = self::getClassName($this->definition);

        $content = $this->mergeBlocks($this->generateClassBodyBlocks());

        return <<<TXT
            <?php

            declare(strict_types=1);

            namespace {$namespace};

            {$this->generateUsingStatements()}
            {$this->generateDocstring()}
            class {$className} extends {$this->definition->parent} implements JsonSerializable
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
        ];
    }

    private function generateFromPayloadMethod(): string
    {
        $fromPayloadMethod = [
            '    /** @phpstan-param array<string,mixed> $payload */',
            '    public static function fromPayload(array $payload): self',
            '    {',
            '        return new self(',
        ];

        $padding = '            ';

        foreach ($this->definition->properties as $propertyDefinition) {
            $key = $propertyDefinition->name;

            $fromPayloadMethod[] = $this->generateFromPayloadMethodArgument($padding, $key, $propertyDefinition);
        }

        $fromPayloadMethod[] = '        );';
        $fromPayloadMethod[] = '    }';

        return implode("\n", $fromPayloadMethod);
    }
}
