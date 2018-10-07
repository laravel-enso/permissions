<?php

use Tests\TestCase;
use LaravelEnso\Core\app\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelEnso\FormBuilder\app\TestTraits\CreateForm;
use LaravelEnso\PermissionManager\app\Models\Permission;
use LaravelEnso\PermissionManager\app\Models\PermissionGroup;
use LaravelEnso\PermissionManager\app\Enums\ResourcePermissions;

class ResourceTest extends TestCase
{
    use CreateForm, RefreshDatabase;

    private $permissionGroup = 'system.resourcePermissions';

    protected function setUp()
    {
        parent::setUp();

        $this->withoutExceptionHandling();

        $this->seed()
            ->actingAs(User::first());
    }

    /** @test */
    public function can_create_resource_permissions()
    {
        $group = factory(PermissionGroup::class)->create([
            'name' => 'test',
            'description' => 'test'
        ]);

        $this->post(
            route('system.resourcePermissions.store'),
            $this->params($group)
        )->assertJson(['redirect' => 'system.permissions.index']);

        $permissions = Permission::wherePermissionGroupId($group->id)
            ->get(['name']);

        $this->assertEquals($this->permissionCount(), $permissions->count());

        $this->assertTrue($this->prefixIsCorrect($permissions, $group->name));
    }

    private function permissionCount()
    {
        return collect(ResourcePermissions::values())
            ->flatten(1)
            ->count();
    }

    private function prefixIsCorrect($permissions, $preffix)
    {
        return $permissions->filter(function ($permission) use ($preffix) {
            return strpos($permission->name, $preffix) !== 0;
        })->count() === 0;
    }

    private function params(PermissionGroup $group)
    {
        return [
            'prefix' => 'testPrefix',
            'permission_group_id' => $group->id,
            'index' => true,
            'create' => true,
            'store' => true,
            'show' => true,
            'edit' => true,
            'update' => true,
            'destroy' => true,
            'initTable' => true,
            'getTableData' => true,
            'exportExcel' => true,
            'options' => true,
        ];
    }
}
