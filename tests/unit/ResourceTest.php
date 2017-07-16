<?php

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use LaravelEnso\PermissionManager\app\Enums\ResourcePermissions;
use LaravelEnso\PermissionManager\app\Models\Permission;
use LaravelEnso\PermissionManager\app\Models\PermissionGroup;
use Tests\TestCase;

class ResourceTest extends TestCase
{
    use DatabaseMigrations;

    private $user;

    protected function setUp()
    {
        parent::setUp();

        $this->disableExceptionHandling();
        $this->user = User::first();
        $this->actingAs($this->user);
    }

    /** @test */
    public function create()
    {
        $response = $this->get('/system/resourcePermissions/create');

        $response->assertStatus(200);
    }

    /** @test */
    public function store()
    {
        $group = PermissionGroup::create(['name' => 'test', 'description' => 'test']);
        $params = $this->postParams($group);

        $response = $this->post('/system/resourcePermissions', $params);

        $permissionCount = $this->getResourcePermissionCount();
        $permissions = Permission::wherePermissionGroupId($group->id)->get(['name']);

        $response->assertRedirect('/system/permissions');
        $this->hasSessionConfirmation($response);
        $this->assertEquals($permissionCount, $permissions->count());
        $this->assertTrue($this->hasRightPreffix($permissions, $group->name));
    }

    private function getResourcePermissionCount()
    {
        $resourcePermissions = (new ResourcePermissions())->getData();
        $count = 0;

        foreach ($resourcePermissions as $group) {
            $count += count($group);
        }
        \Log::info($count);
        return $count;
    }

    private function hasRightPreffix($permissions, $preffix)
    {
        return $permissions->filter(function ($permission) use ($preffix) {
            return strpos($permission->name, $preffix) !== 0;
        })->count() === 0;
    }

    private function hasSessionConfirmation($response)
    {
        return $response->assertSessionHas('flash_notification');
    }

    private function postParams(PermissionGroup $group)
    {
        return [
             'prefix'              => 'testPrefix',
             'permission_group_id' => $group->id,
             'index' => 'on',
             'create' => 'on',
             'store' => 'on',
             'show' => 'on',
             'edit' => 'on',
             'update' => 'on',
             'destroy' => 'on',
             'initTable' => 'on',
             'getTableData' => 'on',
             'exportExcel' => 'on',
             'getOptionsList' => 'on',
        ];
    }
}
