<?php

namespace LaravelEnso\Permissions\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use LaravelEnso\Permissions\Models\Permission;

class PermissionFactory extends Factory
{
    protected $model = Permission::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word,
            'description' => $this->faker->sentence,
            'is_default' => $this->faker->boolean,
        ];
    }
}
