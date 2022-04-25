<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Contracts;

use JsonSerializable;

abstract class MethodRequest implements JsonSerializable
{
    abstract public function method(): string;
}
