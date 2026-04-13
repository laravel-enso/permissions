<?php

namespace LaravelEnso\Permissions\Enums;

use LaravelEnso\Enums\Contracts\Mappable;

enum Verb implements Mappable
{
    public function map(): string
    {
        return match ($this) {
            'HEAD' => Type::Read->value,
            'OPTIONS' => Type::Read->value,
            'GET' => Type::Read->value,
            'POST' => Type::Write->value,
            'PATCH' => Type::Write->value,
            'PUT' => Type::Write->value,
            'DELETE' => Type::Delete->value,
        };
    }
}
