<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\CodeGeneration;

use GusALN\TelegramBotApi\CodeGeneration\Definitions\ObjectTypeDefinition;
use GusALN\TelegramBotApi\CodeGeneration\Definitions\PropertyDefinition;
use InvalidArgumentException;

final class ChildTypeWithTypePropertyObjectCodeGenerator extends TypeObjectCodeGenerator
{
    public function __construct(
        protected ObjectTypeDefinition $definition,
        private string $typePropertyName,
        private string $typePropertyValue,
    ) {
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
            $this->generateProperties(),
            $this->generateConstructorMethod(),
            $this->generateFromPayloadMethod(),
            $this->generateJsonSerializeMethod(),
            $this->generateMethods(),
        ];
    }

    private function generateProperties(): string
    {
        return "    private string \${$this->typePropertyName} = '{$this->typePropertyValue}';";
    }

    protected function generateConstructorMethod(): string
    {
        $property = get_type_property_of_abstract_type($this->definition->parent);
        $properties = array_filter(
            $this->definition->properties,
            fn (PropertyDefinition $p) => $p->name != $property
        );

        return $this->generateConstructorMethodForProperties($properties);
    }

    private function generateMethods(): string
    {
        $propertyDefinition = $this->definition->getPropertyMap()[$this->typePropertyName];
        $typeMethod = camel_case($this->typePropertyName);

        $description = rtrim($propertyDefinition->description).'.';

        return implode("\n", [
            '    /**',
            "     * {$description}",
            '     */',
            "    public function {$typeMethod}(): string",
            '    {',
            "        return \$this->{$this->typePropertyName};",
            '    }',
        ]);
    }

    protected function getPropertiesDeserializableFromPayload(): array
    {
        return array_filter($this->definition->properties, fn (PropertyDefinition $p) => $this->typePropertyName != $p->name);
    }
}
