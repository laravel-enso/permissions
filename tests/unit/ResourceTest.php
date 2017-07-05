<?php

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
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

        // $this->disableExceptionHandling();
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
        $response = $this->post('/system/resourcePermissions/store', $params);

        $permissionsCount = Permission::wherePermissionGroupId($group->id)->count();

        $response->assertRedirect('/system/permissions');
        $this->hasSessionConfirmation($response);
        $this->assertEquals(10, $permissionsCount);
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
             'dataTables'          => 'on',
             'vueSelect'           => 'on',
        ];
    }
}
