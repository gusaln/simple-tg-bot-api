<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\CodeGeneration;

use GusALN\TelegramBotApi\CodeGeneration\Definitions\ObjectTypeDefinition;

class TypeObjectCodeGeneratorFactory
{
    private static ?self $instance = null;

    /**
     * @phpstan-var array<string,array<string,string>>
     */
    private array $classTypeValueMap;

    private function __construct()
    {
        $this->classTypeValueMap = [];

        foreach (ABSTRACT_TYPES as $abstract => $_) {
            $this->classTypeValueMap[$abstract] = array_flip(get_children_map_of_abstract_type($abstract));
        }
    }

    public static function get(): self
    {
        self::$instance ??= new self();

        return self::$instance;
    }

    public function create(ObjectTypeDefinition $definition): TypeObjectCodeGenerator
    {
        if ($definition->isAbstractType()) {
            return new AbstractTypeObjectCodeGenerator($definition);
        }

        if ($definition->isChildType()) {
            return ($propertyName = get_type_property_of_abstract_type($definition->parent))
                ? new ChildTypeWithTypePropertyObjectCodeGenerator(
                    $definition,
                    $propertyName,
                    $this->classTypeValueMap[$definition->parent][$definition->name]
                )
                : new ChildTypeObjectCodeGenerator($definition);
        }

        return new NormalTypeObjectCodeGenerator($definition);
    }
}
