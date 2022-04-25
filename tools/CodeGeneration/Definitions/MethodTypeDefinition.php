<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\CodeGeneration\Definitions;

use JsonSerializable;

class MethodTypeDefinition implements JsonSerializable
{
    /**
     * @param ParameterDefinition[] $parameters
     * @param string[]              $description
     */
    public function __construct(
        public string $name,
        public array $description,
        public array $parameters,
        public MethodTypeReturnDefinition $return,
    ) {
    }

    public static function fromArray(array $typeDefinition): self
    {
        $parameters = array_map(
            fn ($t) => $t instanceof ParameterDefinition ? $t : ParameterDefinition::fromArray($t),
            $typeDefinition['parameters']
        );

        $return = $typeDefinition['return'] instanceof MethodTypeReturnDefinition
            ? $typeDefinition['return']
            : MethodTypeReturnDefinition::fromArray($typeDefinition['return']);

        return new self(
            $typeDefinition['name'],
            $typeDefinition['description'],
            $parameters,
            $return
        );
    }

    public function jsonSerialize(): mixed
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'parameters' => array_map(fn ($p) => $p->jsonSerialize(), $this->parameters),
            'return' => $this->return->jsonSerialize(),
        ];
    }
}
