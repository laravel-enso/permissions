<?php

namespace LaravelEnso\Permissions\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class Permission extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'shortName' => Str::afterLast($this->name, '.'),
            'description' => $this->description,
            'isDefault' => $this->is_default,
            'type' => $this->type(),
        ];
    }
}
