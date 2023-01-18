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

    public static function type(string $verb): self
    {
        return match ($verb) {
            'HEAD' => self::Read,
            'OPTIONS' => self::Read,
            'GET' => self::Read,
            'POST' => self::Write,
            'PATCH' => self::Write,
            'PUT' => self::Write,
            'DELETE' => self::Delete,
            default => self::Link,
        };
    }

    public static function registerBy(): string
    {
        return 'permissionTypes';
    }
}
