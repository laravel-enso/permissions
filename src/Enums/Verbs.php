<?php

namespace LaravelEnso\Permissions\Enums;

use LaravelEnso\Enums\Services\Enum;

class Verbs extends Enum
{
    protected static function data(): array
    {
        return [
            'HEAD' => Types::Read,
            'OPTIONS' => Types::Read,
            'GET' => Types::Read,
            'POST' => Types::Write,
            'PATCH' => Types::Write,
            'PUT' => Types::Write,
            'DELETE' => Types::Delete,
        ];
    }
}
