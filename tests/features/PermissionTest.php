<?php

use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use LaravelEnso\PermissionManager\app\Models\Permission;
use LaravelEnso\PermissionManager\app\Models\PermissionGroup;
use LaravelEnso\RoleManager\app\Models\Role;
use LaravelEnso\TestHelper\app\Classes\TestHelper;

class PermissionTest extends TestHelper
{
    use DatabaseMigrations;

    private $faker;

    protected function setUp()
    {
        parent::setUp();

        // $this->disableExceptionHandling();
        $this->faker = Factory::create();
        $this->signIn(User::first());
    }

    /** @test */
    public function index()
    {
        $this->get('/system/permissions')
            ->assertStatus(200)
            ->assertViewIs('laravel-enso/permissionmanager::permissions.index');
    }

    /** @test */
    public function create()
    {
        $this->get('/system/permissions/create')
            ->assertStatus(200)
            ->assertViewIs('laravel-enso/permissionmanager::permissions.create');
    }

    /** @test */
    public function store()
    {
        $postParams = $this->postParams();
        $response = $this->post('/system/permissions', $postParams);

        $permission = Permission::whereName($postParams['name'])->first();

        $response->assertStatus(200)
            ->assertJsonFragment([
                'message'  => 'The permission was created!',
                'redirect' => '/system/permissions/'.$permission->id.'/edit',
            ]);
    }

    /** @test */
    public function edit()
    {
        $permission = Permission::create($this->postParams());

        $this->get('/system/permissions/'.$permission->id.'/edit')
            ->assertStatus(200)
            ->assertViewIs('laravel-enso/permissionmanager::permissions.edit')
            ->assertViewHas('form');
    }

    /** @test */
    public function update()
    {
        $permission = Permission::create($this->postParams());
        $permission->description = 'edited';

        $this->patch('/system/permissions/'.$permission->id, $permission->toArray())
            ->assertStatus(200)
            ->assertJson(['message' => __(config('labels.savedChanges'))]);

        $this->assertEquals('edited', $permission->fresh()->description);
    }

    /** @test */
    public function destroy()
    {
        $permission = Permission::create($this->postParams());

        $this->delete('/system/permissions/'.$permission->id)
            ->assertStatus(200)
            ->assertJsonFragment(['message']);

        $this->assertNull($permission->fresh());
    }

    /** @test */
    public function cant_destroy_if_has_roles()
    {
        $permission = Permission::create($this->postParams());
        $role = Role::first(['id']);
        $permission->roles()->attach($role->id);

        $this->delete('/system/permissions/'.$permission->id)
            ->assertStatus(455);

        $this->assertNotNull($permission->fresh());
    }

    private function postParams()
    {
        return [
            'permission_group_id' => PermissionGroup::first(['id'])->id,
            'name'                => $this->faker->word,
            'description'         => $this->faker->sentence,
            'type'                => 0,
            'default'             => 0,
            '_method'             => 'POST',
        ];
    }
}
