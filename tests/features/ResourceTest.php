<?php

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use LaravelEnso\PermissionManager\app\Enums\ResourcePermissions;
use LaravelEnso\PermissionManager\app\Models\Permission;
use LaravelEnso\PermissionManager\app\Models\PermissionGroup;
use LaravelEnso\TestHelper\app\Classes\TestHelper;

class ResourceTest extends TestHelper
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();

        // $this->disableExceptionHandling();
        $this->signIn(User::first());
    }

    /** @test */
    public function create()
    {
        $this->get('/system/resourcePermissions/create')
            ->assertStatus(200)
            ->assertViewIs('laravel-enso/permissionmanager::permissions.createResource');
    }

    /** @test */
    public function store()
    {
        $group  = PermissionGroup::create(['name' => 'test', 'description' => 'test']);
        $params = $this->postParams($group);

        $this->post('/system/resourcePermissions', $params)
            ->assertRedirect('/system/permissions')
            ->assertSessionHas('flash_notification');

        $permissions = Permission::wherePermissionGroupId($group->id)->get(['name']);

        $this->assertEquals($this->getPermissionCount(), $permissions->count());
        $this->assertTrue($this->hasRightPrefix($permissions, $group->name));
    }

    private function getPermissionCount()
    {
        $resourcePermissions = (new ResourcePermissions())->getData();

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
            'index'               => 'on',
            'create'              => 'on',
            'store'               => 'on',
            'show'                => 'on',
            'edit'                => 'on',
            'update'              => 'on',
            'destroy'             => 'on',
            'initTable'           => 'on',
            'getTableData'        => 'on',
            'exportExcel'         => 'on',
            'getOptionList'       => 'on',
        ];
    }
}
