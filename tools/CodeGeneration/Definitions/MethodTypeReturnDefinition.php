<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\CodeGeneration\Definitions;

class MethodTypeReturnDefinition extends TypedDefinition
{
    public string $individualType;

    /**
     * @param string[] $types
     * @param string[] $nonPrimitiveTypes
     */
    public function __construct(
        public string $description,
        public array $types,
        public bool $isArray,
        public array $nonPrimitiveTypes,
    ) {
        $this->individualType = $this->isUnion() ? 'mixed' : $this->singleType();
    }

    public function isNullable(): bool
    {
        return false;
    }

    public static function fromArray(array $payload): self
    {
        return new self(
            $payload['description'],
            $payload['types'],
            $payload['isArray'],
            $payload['nonPrimitiveTypes'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return [
            'description' => $this->description,
            'types' => $this->types,
            'isArray' => $this->isArray,
            'isUnion' => $this->isUnion(),
            'nonPrimitiveTypes' => $this->nonPrimitiveTypes,
        ];
    }
}
