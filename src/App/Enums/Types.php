<?php

namespace LaravelEnso\Permissions\App\Enums;

use LaravelEnso\Enums\App\Services\Enum;

class Types extends Enum
{
    public const Read = 'Read';
    public const Write = 'Write';
    public const Delete = 'Delete';
    public const Link = 'Link';
}
