<?php

namespace LaravelEnso\Permissions\Enums;

use LaravelEnso\Enums\Contracts\Frontend;

enum Type: string implements Frontend
{
    case Read = 'Read';
    case Write = 'Write';
    case Delete = 'Delete';
    case Link = 'Link';
    case Menu = 'Menu';

    public static function registerBy(): string
    {
        return 'permissionTypes';
    }
}
