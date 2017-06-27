<?php

use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use LaravelEnso\PermissionManager\app\Models\Permission;
use LaravelEnso\RoleManager\app\Models\Role;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    use DatabaseMigrations;

    private $user;

    protected function setUp()
    {
        parent::setUp();

        // $this->disableExceptionHandling();
        $this->user = User::first();
        $this->faker = Factory::create();
        $this->actingAs($this->user);
    }

    /** @test */
    public function index()
    {
        $response = $this->get('/system/permissions');

        $response->assertStatus(200);
    }

    /** @test */
    public function create()
    {
        $response = $this->get('/system/permissions/create');

        $response->assertStatus(200);
    }

    /** @test */
    public function store()
    {
        $response = $this->post('/system/permissions', $this->postParams());

        $permission = Permission::whereName('testPermission')->first();

        $response->assertRedirect('/system/permissions/'.$permission->id.'/edit');
        $this->hasSessionConfirmation($response);
    }

    /** @test */
    public function edit()
    {
        $permission = Permission::first();
        $permission->roles_list;

        $response = $this->get('/system/permissions/'.$permission->id.'/edit');

        $response->assertStatus(200);
        $response->assertViewHas('permission', $permission);
    }

    /** @test */
    public function update()
    {
        $permission = Permission::first();
        $permission->description = 'edited';
        $data = $permission->toArray();
        $data['_method'] = 'PATCH';

        $response = $this->patch('/system/permissions/'.$permission->id, $data);

        $response->assertStatus(302);
        $this->hasSessionConfirmation($response);
        $this->assertTrue($this->wasUpdated());
    }

    /** @test */
    public function destroy()
    {
        $postParams = $this->postParams();
        Permission::create($postParams);
        $permission = Permission::whereName($postParams['name'])->first();

        $response = $this->delete('/system/permissions/'.$permission->id);

        $this->hasJsonConfirmation($response);
        $response->assertStatus(200);
    }

    /** @test */
    public function cantDestroyIfHasRoles()
    {
        $postParams = $this->postParams();
        Permission::create($postParams);
        $role = Role::first(['id']);
        $permission = Permission::whereName($postParams['name'])->first();
        $permission->roles()->attach($role->id);

        $response = $this->delete('/system/permissions/'.$permission->id);

        $response->assertStatus(302);
        $this->assertTrue($this->hasSessionErrorMessage());
    }

    private function postParams()
    {
        return [
            'permission_group_id'   => 1,
            'name'                  => 'testPermission',
            'description'           => 'testDescription',
            'type'                  => 0,
            'default'               => 0,
            '_method'               => 'POST',
        ];
    }

    private function wasCreated()
    {
        $permission = Permission::whereName('testPermission')->first(['name']);

        return $permission->name === 'testPermission';
    }

    private function wasUpdated()
    {
        $permission = Permission::first(['description']);

        return $permission->description === 'edited';
    }

    private function hasSessionConfirmation($response)
    {
        return $response->assertSessionHas('flash_notification');
    }

    private function hasJsonConfirmation($response)
    {
        return $response->assertJsonFragment(['message']);
    }

    private function hasSessionErrorMessage()
    {
        return session('flash_notification')[0]->level === 'danger';
    }
}
