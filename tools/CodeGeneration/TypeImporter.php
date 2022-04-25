<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\CodeGeneration;

use GusALN\TelegramBotApi\CodeGeneration\Definitions\MethodTypeDefinition;
use GusALN\TelegramBotApi\CodeGeneration\Definitions\MethodTypeReturnDefinition;
use GusALN\TelegramBotApi\CodeGeneration\Definitions\ObjectTypeDefinition;
use GusALN\TelegramBotApi\CodeGeneration\Definitions\ParameterDefinition;
use GusALN\TelegramBotApi\CodeGeneration\Definitions\PropertyDefinition;
use Symfony\Component\DomCrawler\Crawler;

class TypeImporter
{
    public const TG_BOT_DOCS_URL = 'https://core.telegram.org/bots/api';
    public const REQUIRED_STRING = 'Yes';
    public const OPTIONAL_STRING = 'Optional';

    public const ARRAY_TYPE_PATTERN = '/Array of ([a-z]+)/i';

    public const TYPE_ALIASES = [
        'True' => 'bool',
        'Boolean' => 'bool',
        'Bool' => 'bool',
        'String' => 'string',
        'Float number' => 'float',
        'Float' => 'float',
        'Int' => 'int',
        'Integer' => 'int',
        'Array' => 'array',
    ];

    /**
     * @phpstan-return array{ObjectTypeDefinition[], MethodTypeDefinition[]}
     */
    public static function getTypeDefinitions(string $telegramDocsHtml = null): array
    {
        $apiDocs = new Crawler($telegramDocsHtml ?? self::fetchDocsHtml());

        $definitions = array_merge(
            self::getDefinitions($apiDocs, 'getting-updates'),
            self::getDefinitions($apiDocs, 'available-types'),
            self::getDefinitions($apiDocs, 'available-methods'),
            self::getDefinitions($apiDocs, 'updating-messages'),
            self::getDefinitions($apiDocs, 'stickers'),
            self::getDefinitions($apiDocs, 'inline-mode'),
            self::getDefinitions($apiDocs, 'payments'),
            self::getDefinitions($apiDocs, 'telegram-passport'),
            self::getDefinitions($apiDocs, 'games'),
        );

        $types = array_map(
            function ($payload) {
                $payload['properties'] = array_map(fn ($t) => self::parsePropertyDefinition($t), $payload['properties']);

                return ObjectTypeDefinition::fromArray($payload);
            },
            self::fillParentAndChildren(array_filter($definitions, fn ($d) => ! $d['isMethod']))
        );

        $methods = array_map(
            function ($payload) {
                $payload['parameters'] = array_map(fn ($t) => self::parseParameterDefinition($t), $payload['parameters']);
                $payload['return'] = self::parseReturnDefinition($payload['return']);

                return MethodTypeDefinition::fromArray($payload);
            },
            self::fillReturnTypes(array_filter($definitions, fn ($d) => $d['isMethod']))
        );

        return [$types, $methods];
    }

    public static function fetchDocsHtml(): string
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::TG_BOT_DOCS_URL);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    private static function nodesBefore(Crawler $crawler, string $nodeName): Crawler
    {
        $beforeNodeName = true;

        return $crawler
            ->nextAll()
            ->reduce(function (Crawler $node) use (&$beforeNodeName, $nodeName) {
                if (! $beforeNodeName) {
                    return false;
                }

                if ($node->nodeName() == $nodeName) {
                    return $beforeNodeName = false;
                }

                return;
            });
    }

    private static function makeNewTypeDefinition(string $name): array
    {
        return [
            'name' => $name,
            'description' => [],
            'isMethod' => $name[0] == strtolower($name[0]),
        ];
    }

    private static function getDefinitions(Crawler $crawler, string $section): array
    {
        $nodesAfterTitle = $crawler->filter("h3 > a[name=\"{$section}\"]")->ancestors();

        $nodesInThisSection = self::nodesBefore($nodesAfterTitle, 'h3');

        $definitions = [];
        $newTypeDefinition = null;
        foreach ($nodesInThisSection as $node) {
            if (is_null($newTypeDefinition)) {
                if ('h4' == $node->nodeName) {
                    $newTypeDefinition = self::makeNewTypeDefinition((new Crawler($node))->text());
                } else {
                    continue;
                }
            }

            switch ($node->nodeName) {
                case 'h4':
                    if (! str_contains($newTypeDefinition['name'], ' ')) {
                        $definitions[$newTypeDefinition['name']] = $newTypeDefinition;
                    }

                    $newTypeDefinition = self::makeNewTypeDefinition((new Crawler($node))->text());
                    $newTypeDefinition[$newTypeDefinition['isMethod'] ? 'parameters' : 'properties'] = [];
                    break;

                case 'p':
                    $newTypeDefinition['description'][] = escape_string((new Crawler($node))->text());
                    break;

                case 'ul':
                case 'ol':
                    foreach ((new Crawler($node)) as $domNode) {
                        $newTypeDefinition['description'][] = $domNode->nodeValue;
                    }
                    break;

                case 'table':
                    $typeAttributes = [];
                    $attributeDescriptors = (new Crawler($node))->children('tbody tr');
                    $attributeDescriptors->each(
                        static function (Crawler $descriptor) use (&$typeAttributes, $newTypeDefinition) {
                            $tags = explode("\n", trim($descriptor->getNode(0)->textContent));

                            if ($newTypeDefinition['isMethod']) {
                                $typeAttributes[] = [
                                    'name' => $tags[0],
                                    'type' => $tags[1],
                                    'required' => self::REQUIRED_STRING == trim($tags[2]),
                                    'description' => escape_string($tags[3]),
                                ];
                            } else {
                                $typeAttributes[] = [
                                    'name' => $tags[0],
                                    'type' => $tags[1],
                                    'description' => escape_string($tags[2]),
                                    'nullable' => str_contains($tags[2], self::OPTIONAL_STRING),
                                ];
                            }
                        }
                    );

                    $attributesKey = $newTypeDefinition['isMethod'] ? 'parameters' : 'properties';
                    $newTypeDefinition[$attributesKey] = $typeAttributes;
                    break;

                default:
                    break;
            }
        }

        if (! str_contains($newTypeDefinition['name'], ' ')) {
            $definitions[$newTypeDefinition['name']] = $newTypeDefinition;
        }

        return $definitions;
    }

    private static function fillParentAndChildren(array $typeDefinitions): array
    {
        $childParentMap = [];

        foreach (ABSTRACT_TYPES as $parentType => $attrs) {
            foreach ($attrs['childrenMap'] as $childType) {
                $childParentMap[$childType] = $parentType;
            }
        }

        foreach ($typeDefinitions as $name => &$type) {
            if (isset($childParentMap[$name])) {
                $type['parent'] = $childParentMap[$name];
            }
        }

        return $typeDefinitions;
    }

    private static function fillReturnTypes(array $methodDefinitions): array
    {
        $returnDescriptionSpecialPatterns = [
            'Array of Update' => '/An Array of Update objects is returned./i',
            'MessageId' => '/Returns the MessageId of the sent message on success./i',
            'Array of Message' => '/On success, an array of Messages that were sent is returned./i',
            'Message or True' => [
                '/On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned./i',
                '/On success, if the message is not an inline message, the edited Message is returned, otherwise True is returned./i',
                '/On success, if the message is not an inline message, the Message is returned, otherwise True is returned./i',
            ],
            'User' => '/Returns basic information about the bot in form of a User object./i',
            'Array of ChatMember' => '/On success, returns an Array of ChatMember objects that contains information about all chat administrators except other bots./i',
            'Array of BotCommand' => '/Returns Array of BotCommand on success./i',
            'Poll' => '/On success, the stopped Poll is returned./i',
            'Array of GameHighScore' => '/On success, returns an Array of GameHighScore objects./i',
            // 'mixed' => "/Returns an error, if the new score is not greater than the user's current score in the chat and force is False./i",
        ];
        $returnDescriptionSimplePatterns = [
            "/Returns(?:[ a-z]+)? ([a-z]+) object(?:[ a-z]+)?\./i",
            "/Returns(?:[ a-z]+)? ([a-z]+) on success\./i",
            "/On success, (?:the sent )?([a-z]+) is returned\./i",
            "/On success, a ([a-z]+)(?: object)? is returned\./i",
        ];

        foreach ($methodDefinitions as $name => &$method) {
            $description = implode("\n", $method['description']);
            foreach ($returnDescriptionSpecialPatterns as $type => $patterns) {
                $patterns = is_string($patterns) ? [$patterns] : $patterns;

                foreach ($patterns as $pattern) {
                    $matches = [];
                    if (! preg_match($pattern, $description, $matches)) {
                        continue;
                    }

                    $method['return'] = [
                        'description' => escape_string($matches[0]),
                        'type' => $type,
                    ];

                    break;
                }

                if (isset($method['return']) && empty($method['return']['type'])) {
                    echo json_encode(compact('pattern', 'matches', 'method'), JSON_PRETTY_PRINT).PHP_EOL;
                    exit(0);
                }

                if (isset($method['return'])) {
                    break;
                }
            }

            if (isset($method['return'])) {
                continue;
            }

            foreach ($returnDescriptionSimplePatterns as $pattern) {
                $matches = [];
                if (! preg_match($pattern, $description, $matches)) {
                    continue;
                }

                $method['return'] = [
                    'description' => escape_string($matches[0]),
                    'type' => $matches[1],
                ];

                if (empty($method['return']['type'])) {
                    echo json_encode(compact('pattern', 'matches', 'method'), JSON_PRETTY_PRINT).PHP_EOL;
                    exit(0);
                }

                break;
            }

            if (isset($method['return'])) {
                continue;
            }

            $method['return'] = [
                'description' => null,
                'type' => 'mixed',
            ];
        }

        return $methodDefinitions;
    }

    private static function parseTypeDetails(string $rawType): array
    {
        $nonPrimitiveTypes = [];
        $isArray = false;

        if (preg_match(self::ARRAY_TYPE_PATTERN, $rawType, $matches)) {
            $rawType = $matches[1];
            $isArray = true;
        } elseif (str_contains($rawType, ' or ')) {
            $rawType = explode(' or ', $rawType);
        }
        $rawType = (array) $rawType;

        $types = [];
        foreach ($rawType as $t) {
            if (isset(self::TYPE_ALIASES[$t])) {
                $types[] = self::TYPE_ALIASES[$t];
            } else {
                $nonPrimitiveTypes[] = $t;
                $types[] = $t;
            }
        }

        return [
            $types,
            $nonPrimitiveTypes,
            $isArray,
        ];
    }

    private static function parsePropertyDefinition(array $attributeDefinition): PropertyDefinition
    {
        $isNullable = $attributeDefinition['nullable'];

        [$types, $nonPrimitiveTypes, $isArray] = self::parseTypeDetails(trim($attributeDefinition['type']));

        return new PropertyDefinition(
            $attributeDefinition['name'],
            $attributeDefinition['description'],
            $types,
            $isArray,
            $isNullable,
            $nonPrimitiveTypes
        );
    }

    private static function parseParameterDefinition(array $parameterDefinition): ParameterDefinition
    {
        $isRequired = $parameterDefinition['required'];

        [$types, $nonPrimitiveTypes, $isArray] = self::parseTypeDetails(trim($parameterDefinition['type']));

        return new ParameterDefinition(
            $parameterDefinition['name'],
            $parameterDefinition['description'],
            $types,
            $isArray,
            $isRequired,
            $nonPrimitiveTypes
        );
    }

    private static function parseReturnDefinition(array $returnDefinition): MethodTypeReturnDefinition
    {
        if ('mixed' == $returnDefinition['type']) {
            return new MethodTypeReturnDefinition(
                description: $returnDefinition['description'],
                types: [$returnDefinition['type']],
                isArray: false,
                nonPrimitiveTypes: []
            );
        }

        [$types, $nonPrimitiveTypes, $isArray] = self::parseTypeDetails(trim($returnDefinition['type']));

        return new MethodTypeReturnDefinition(
            $returnDefinition['description'],
            $types,
            $isArray,
            $nonPrimitiveTypes
        );
    }
}
