<?php

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelEnso\PermissionManager\app\Enums\ResourcePermissions;
use LaravelEnso\PermissionManager\app\Models\Permission;
use LaravelEnso\PermissionManager\app\Models\PermissionGroup;
use LaravelEnso\TestHelper\app\Traits\SignIn;
use LaravelEnso\TestHelper\app\Traits\TestCreateForm;
use Tests\TestCase;

class ResourceTest extends TestCase
{
    use RefreshDatabase, SignIn, TestCreateForm;

    private $prefix = 'system.resourcePermissions';

    protected function setUp()
    {
        parent::setUp();

        // $this->withoutExceptionHandling();
        $this->signIn(User::first());
    }

    /** @test */
    public function store()
    {
        $group = PermissionGroup::create(['name' => 'test', 'description' => 'test']);
        $params = $this->postParams($group);

        $this->post(route('system.resourcePermissions.store', [], false), $params)
            ->assertJson(['redirect' => 'system.permissions.index']);

        $permissions = Permission::wherePermissionGroupId($group->id)->get(['name']);

        $this->assertEquals($this->getPermissionCount(), $permissions->count());
        $this->assertTrue($this->hasRightPrefix($permissions, $group->name));
    }

    private function getPermissionCount()
    {
        $resourcePermissions = ResourcePermissions::values();

        $count = 0;

        foreach ($resourcePermissions as $group) {
            $count += count($group);
        }

        return $count;
    }

    private function hasRightPrefix($permissions, $preffix)
    {
        return $permissions->filter(function ($permission) use ($preffix) {
            return strpos($permission->name, $preffix) !== 0;
        })->count() === 0;
    }

    private function postParams(PermissionGroup $group)
    {
        return [
            'prefix'              => 'testPrefix',
            'permission_group_id' => $group->id,
            'index'               => true,
            'create'              => true,
            'store'               => true,
            'show'                => true,
            'edit'                => true,
            'update'              => true,
            'destroy'             => true,
            'initTable'           => true,
            'getTableData'        => true,
            'exportExcel'         => true,
            'getOptionList'       => true,
        ];
    }
}
