<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\CodeGeneration;

use GusALN\TelegramBotApi\CodeGeneration\Definitions\ObjectTypeDefinition;
use InvalidArgumentException;

final class AbstractTypeObjectCodeGenerator extends TypeObjectCodeGenerator
{
    private ?string $typePropertyName;

    public function __construct(protected ObjectTypeDefinition $definition)
    {
        if (! $this->definition->isAbstractType()) {
            $type = $this->definition->name;
            throw new InvalidArgumentException("Type {$type} is not an AbstractType");
        }

        $this->typePropertyName = get_type_property_of_abstract_type($this->definition->name);
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
            abstract class {$className} implements JsonSerializable
            {
            {$content}
            }
            TXT;
    }

    protected function generateClassBodyBlocks(): array
    {
        return [
            $this->generateConstants(),
            $this->generateTypePropertyMethod(),
            $this->generateFromPayloadMethod(),
        ];
    }

    private function generateTypePropertyMethod(): ?string
    {
        if (empty($this->typePropertyName)) {
            return null;
        }

        $typeMethod = camel_case($this->typePropertyName);

        return "    abstract public function {$typeMethod}(): string;";
    }

    protected function generateUsingStatements(): string
    {
        $usingStatements = [
            'use JsonSerializable;',
            'use InvalidArgumentException;',
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

    private function generateConstants(): ?string
    {
        if (empty($this->typePropertyName)) {
            return null;
        }

        $lines = [];

        $padding = '    ';
        foreach (get_children_map_of_abstract_type($this->definition->name) as $propertyValue => $childType) {
            $constName = strtoupper(snake_case($childType).'_'.$this->typePropertyName);

            $lines[] = "{$padding}public const {$constName} = '{$propertyValue}';";
        }

        return implode("\n", $lines);
    }

    protected function generateFromPayloadMethod(): string
    {
        if ('InputMessageContent' == $this->definition->name) {
            return $this->generateFromPayloadMethodForInputMessageContent();
        }

        $lines = [
            "    /** @phpstan-param array{{$this->typePropertyName}: string} \$payload */",
            '    public static function fromPayload(array $payload): self',
            '    {',
            "        return match(\$payload['{$this->typePropertyName}']) {",
        ];

        $padding = '            ';
        foreach (get_children_map_of_abstract_type($this->definition->name) as $propertyValue => $childType) {
            $lines[] = "{$padding}'{$propertyValue}' => {$childType}::fromPayload(\$payload),";
        }

        $lines[] = "{$padding}default => throw new InvalidArgumentException(sprintf('Type %s is not a child of %s', \$payload['{$this->typePropertyName}'], {$this->definition->name}::class)),";

        $lines[] = '        };';
        $lines[] = '    }';

        return implode("\n", $lines);
    }

    private function generateFromPayloadMethodForInputMessageContent()
    {
        return <<<TXT
                /** @phpstan-param array<string,mixed> \$payload */
                public static function fromPayload(array \$payload = []): self
                {
                    if (isset(\$payload['message_text'])) {
                        return InputTextMessageContent::fromPayload(\$payload);
                    }

                    if (isset(\$payload['proximity_alert_radius'])) {
                        return InputLocationMessageContent::fromPayload(\$payload);
                    }

                    if (isset(\$payload['address'])) {
                        return InputVenueMessageContent::fromPayload(\$payload);
                    }

                    if (isset(\$payload['phone_number'])) {
                        return InputContactMessageContent::fromPayload(\$payload);
                    }

                    if (isset(\$payload['prices'])) {
                        return InputInvoiceMessageContent::fromPayload(\$payload);
                    }

                    throw new InvalidArgumentException(sprintf('The payload is not a child of %s', InputMessageContent::class));
                }
            TXT;
    }
}
