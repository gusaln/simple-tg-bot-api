<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\CodeGeneration\Definitions;

use function GusALN\TelegramBotApi\CodeGeneration\is_abstract_type;
use JsonSerializable;

class ObjectTypeDefinition implements JsonSerializable
{
    /**
     * @param PropertyDefinition[] $properties
     * @param string[]             $description
     */
    public function __construct(
        public string $name,
        public array $description,
        public array $properties,
        public ?string $parent = null,
    ) {
    }

    /**
     * @phpstan-param array{name: string, description: string[], properties: (array|PropertyDefinition)[], parent: string|null} $typeDefinition
     */
    public static function fromArray(array $typeDefinition): self
    {
        $properties = array_map(
            fn ($t) => $t instanceof PropertyDefinition ? $t : PropertyDefinition::fromArray($t),
            $typeDefinition['properties']
        );

        return new self(
            $typeDefinition['name'],
            $typeDefinition['description'],
            $properties,
            $typeDefinition['parent'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'properties' => array_map(fn ($p) => $p->jsonSerialize(), $this->properties),
            'parent' => $this->parent,
        ];
    }

    public function isAbstractType(): bool
    {
        return is_abstract_type($this->name);
    }

    public function isChildType(): bool
    {
        return null != $this->parent;
    }

    /**
     * Map from propertyName to PropertyDefinition.
     *
     * @return array<string,PropertyDefinition>
     */
    public function getPropertyMap(): array
    {
        return array_combine(
            array_map(fn (PropertyDefinition $p) => $p->name, $this->properties),
            $this->properties
        );
    }
}
