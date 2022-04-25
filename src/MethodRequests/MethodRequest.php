<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use JsonSerializable;

abstract class MethodRequest implements JsonSerializable
{
    abstract public function method(): string;
}
