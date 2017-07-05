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
        $response = $this->post('/system/resourcePermissions/store', $this->postParams());

        $permissionsCount = Permission::wherePermissionGroupId(1)->count();

        $response->assertRedirect('/system/permissions');
        $this->hasSessionConfirmation($response);
        $this->assertTrue(10, $permissionsCount);
    }

    private function hasSessionConfirmation($response)
    {
        return $response->assertSessionHas('flash_notification');
    }

    private function postParams()
    {
        return [
             'prefix'              => 'testPrefix',
             'permission_group_id' => PermissionGroup::first(['id'])->id,
             'dataTables'          => 'on',
             'vueSelect'           => 'on',
        ];
    }
}
