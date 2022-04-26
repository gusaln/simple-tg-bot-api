<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\CodeGeneration;

use GusALN\TelegramBotApi\CodeGeneration\Definitions\MethodTypeDefinition;
use GusALN\TelegramBotApi\CodeGeneration\Definitions\ObjectTypeDefinition;

class BotApiCodeGenerator extends CodeGenerator
{
    /**
     * @param ObjectTypeDefinition[] $objectTypeDefinitions
     * @param MethodTypeDefinition[] $methodDefinitions
     */
    public function __construct(
        private array $objectTypeDefinitions,
        private array $methodDefinitions
    ) {
    }

    public function generate(): void
    {
        file_put_contents($this->getFilePath(), $this->generateFileContent());
    }

    public static function getClassName(): string
    {
        return 'BotApi';
    }

    public static function getClassNamespace(): string
    {
        return 'GusALN\TelegramBotApi';
    }

    public static function getFqn(string $className): string
    {
        return self::getClassNamespace().'\\'.$className;
    }

    public function getFilePath(): string
    {
        return __DIR__.'/../../src/'.self::getClassName().'.php';
    }

    public function generateFileContent(): string
    {
        $className = self::getClassName();
        $namespace = self::getClassNamespace();

        $usingStatements = $this->generateUsingStatements();

        $methods = $this->generateMethods();

        return <<<TXT
            <?php

            declare(strict_types=1);

            namespace {$namespace};

            {$usingStatements}
            class {$className} extends BaseBotApi
            {
            {$methods}
            }

            TXT;
    }

    private function generateUsingStatements(): string
    {
        $usingStatements = [];

        foreach ($this->methodDefinitions as $definition) {
            foreach ($definition->return->types as $type) {
                if ($this->isPrimitive($type) || 'mixed' == $type) {
                    continue;
                }

                $usingStatements[] = 'use '
                    .TypeObjectCodeGenerator::getFqn(
                        TypeObjectCodeGenerator::getClassName($this->objectTypeDefinitions[$type])
                    )
                    .';';
            }
        }

        foreach ($this->methodDefinitions as $definition) {
            $usingStatements[] = 'use '
                .MethodRequestObjectCodeGenerator::getFqn(MethodRequestObjectCodeGenerator::getClassName($definition))
                .';';
        }

        sort($usingStatements);

        return implode("\n", array_unique($usingStatements))."\n";
    }

    private function generateMethods(): string
    {
        return implode("\n\n", array_map(fn ($method) => $this->generateMethod($method), $this->methodDefinitions));
    }

    private function generateMethod(MethodTypeDefinition $definition): string
    {
        $docstringPadding = '     ';
        $methodDocstring = [];
        foreach ($definition->description as $descLine) {
            foreach (explode("\n", $descLine) as $line) {
                $methodDocstring[] = "{$docstringPadding}* {$line}";
            }
        }

        $methodName = $definition->name;
        $methodArgument = MethodRequestObjectCodeGenerator::getClassName($definition);
        $methodReturn = $definition->return->typeHint();
        if ($definition->return->typeHint() != $definition->return->docstringTypeHint()) {
            $methodDocstring[] = "{$docstringPadding}*";
            $methodDocstring[] = "{$docstringPadding}* @return {$definition->return->docstringTypeHint()}";
        }

        $body = '$this->call($request)->getPayload()';
        if (! $definition->return->isUnion()) {
            if ($definition->return->isArray) {
                $body = "array_map(fn (\$p) => {$definition->return->individualType}::fromPayload(\$p), {$body})";
            } elseif (! $this->isPrimitive($definition->return->singleType()) && 'mixed' != $definition->return->singleType()) {
                $body = "{$definition->return->singleType()}::fromPayload({$body})";
            }
        } elseif (2 == count($definition->return->types) && in_array('bool', $definition->return->types)) {
            $object = ! $this->isPrimitive($definition->return->types[0])
                ? $definition->return->types[0]
                : $definition->return->types[1];

            $body = "is_bool(\$payload = {$body}) ? \$payload : {$object}::fromPayload(\$payload)";
        }
        $body = "return {$body};";

        $methodDocstring = implode("\n", $methodDocstring);

        return <<<TXT
                /**
            {$methodDocstring}
                 */
                public function {$methodName}({$methodArgument} \$request): {$methodReturn}
                {
                    {$body}
                }
            TXT;
    }
}
