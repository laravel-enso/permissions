<?php

namespace LaravelEnso\Permissions\App\Enums;

use LaravelEnso\Enums\App\Services\Enum;

class Types extends Enum
{
    public const Read = 'Read';
    public const Write = 'Write';
    public const Delete = 'Delete';
    public const Link = 'Link';

    protected static function data(): array
    {
        return [
            'Read' => self::Read,
            'Write' => self::Write,
            'Delete' => self::Delete,
            'Link' => self::Link,
            'HEAD' => self::Read,
            'OPTIONS' => self::Read,
            'GET' => self::Read,
            'POST' => self::Write,
            'PATCH' => self::Write,
            'PUT' => self::Write,
            'DELETE' => self::Delete,
        ];
    }
}
