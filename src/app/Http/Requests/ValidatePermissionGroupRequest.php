<?php

namespace LaravelEnso\PermissionManager\app\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ValidatePermissionGroupRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $permissionGroup = $this->route('permissionGroup');
        $nameUnique = Rule::unique('permission_groups', 'name');

        $nameUnique = request()->getMethod() === 'PATCH'
            ? $nameUnique->ignore($permissionGroup->id)
            : $nameUnique;

        return [
            'name' => ['required', $nameUnique],
            'description' => 'required',
        ];
    }
}
