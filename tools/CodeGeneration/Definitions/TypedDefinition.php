<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\CodeGeneration\Definitions;

abstract class TypedDefinition
{
    public array $types;

    public bool $isArray;

    abstract public function isNullable(): bool;

    /**
     * Returns the single type of the definition if it has only one, null otherwise.
     */
    public function singleType(): ?string
    {
        return $this->isUnion() ? null : $this->types[0];
    }

    public function isUnion(): bool
    {
        return count($this->types) > 1;
    }

    /**
     * Generates the type-hint for this definition.
     */
    public function typeHint(): string
    {
        $hint = $this->isArray ? 'array' : implode('|', $this->types);

        if ($this->isUnion()) {
            return $this->isNullable() ? "{$hint}|null" : $hint;
        }

        return $this->isNullable() ? "?{$hint}" : $hint;
    }

    /**
     * Generates the docstring type-hint for this definition.
     */
    public function docstringTypeHint(): string
    {
        $hint = implode('|', $this->types);
        if ($this->isArray) {
            $hint = "{$hint}[]";
        }

        return $this->isNullable() ? "{$hint}|null" : $hint;
    }
}
