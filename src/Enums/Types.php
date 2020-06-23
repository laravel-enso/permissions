<?php

namespace LaravelEnso\Permissions\Enums;

use LaravelEnso\Enums\Services\Enum;

class Types extends Enum
{
    public const Read = 'Read';
    public const Write = 'Write';
    public const Delete = 'Delete';
    public const Link = 'Link';
    public const Menu = 'Menu';
}
