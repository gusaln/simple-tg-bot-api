<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\CodeGeneration;

use GusALN\TelegramBotApi\CodeGeneration\Definitions\ObjectTypeDefinition;

class NormalTypeObjectCodeGenerator extends TypeObjectCodeGenerator
{
    public function __construct(protected ObjectTypeDefinition $definition)
    {
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
            class {$className} implements JsonSerializable
            {
            {$content}
            }
            TXT;
    }

    protected function generateClassBodyBlocks(): array
    {
        return [
            $this->generateConstants(),
            $this->generateConstructorMethod(),
            $this->generateFromPayloadMethod(),
            $this->generateJsonSerializeMethod(),
        ];
    }

    protected function generateConstants(): ?string
    {
        if ('MessageEntity' == $this->definition->name) {
            return <<<TXT
                    public const MESSAGE_MENTION_TYPE = "mention";
                    public const MESSAGE_HASHTAG_TYPE = "hashtag";
                    public const MESSAGE_CASHTAG_TYPE = "cashtag";
                    public const MESSAGE_BOT_COMMAND_TYPE = "bot_command";
                    public const MESSAGE_URL_TYPE = "url";
                    public const MESSAGE_EMAIL_TYPE = "email";
                    public const MESSAGE_PHONE_NUMBER_TYPE = "phone_number";
                    public const MESSAGE_BOLD_TYPE = "bold";
                    public const MESSAGE_ITALIC_TYPE = "italic";
                    public const MESSAGE_UNDERLINE_TYPE = "underline";
                    public const MESSAGE_STRIKETHROUGH_TYPE = "strikethrough";
                    public const MESSAGE_SPOILER_TYPE = "spoiler";
                    public const MESSAGE_CODE_TYPE = "code";
                    public const MESSAGE_PRE_TYPE = "pre";
                    public const MESSAGE_TEXT_LINK_TYPE = "text_link";
                    public const MESSAGE_TEXT_MENTION_TYPE = "text_mention";
                TXT;
        }

        return null;
    }
}
