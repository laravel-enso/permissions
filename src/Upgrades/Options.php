<?php

namespace LaravelEnso\Permissions\Upgrades;

use LaravelEnso\Upgrade\Contracts\MigratesStructure;
use LaravelEnso\Upgrade\Traits\StructureMigration;

class Options implements MigratesStructure
{
    use StructureMigration;

    private array $permissions = [
        ['name' => 'system.permissions.options', 'description' => 'Get options for select', 'is_default' => false],
    ];
}
