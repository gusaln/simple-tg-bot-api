<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\CodeGeneration\Definitions;

class ParameterDefinition extends TypedDefinition
{
    /**
     * @param string[] $types
     * @param string[] $nonPrimitiveTypes
     */
    public function __construct(
        public string $name,
        public string $description,
        public array $types,
        public bool $isArray,
        public bool $isRequired,
        public array $nonPrimitiveTypes,
    ) {
    }

    public function isNullable(): bool
    {
        return ! $this->isRequired;
    }

    public static function fromArray(array $payload): self
    {
        return new self(
            $payload['name'],
            $payload['description'],
            $payload['types'],
            $payload['isArray'],
            $payload['isRequired'],
            $payload['nonPrimitiveTypes'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'types' => $this->types,
            'isArray' => $this->isArray,
            'isUnion' => $this->isUnion(),
            'isRequired' => $this->isRequired,
            'nonPrimitiveTypes' => $this->nonPrimitiveTypes,
        ];
    }
}
