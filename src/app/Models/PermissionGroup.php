<?php

namespace LaravelEnso\PermissionManager\app\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\Helpers\Traits\DMYTimestamps;

class PermissionGroup extends Model
{
	use DMYTimestamps;

    protected $fillable = ['name', 'description'];

    public function permissions()
    {
        return $this->hasMany('LaravelEnso\PermissionManager\app\Models\Permission');
    }
}
