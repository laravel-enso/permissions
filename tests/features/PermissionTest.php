<?php

use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use LaravelEnso\PermissionManager\app\Models\Permission;
use LaravelEnso\PermissionManager\app\Models\PermissionGroup;
use LaravelEnso\RoleManager\app\Models\Role;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    use DatabaseMigrations;

    private $faker;

    protected function setUp()
    {
        parent::setUp();

        // $this->disableExceptionHandling();
        $this->faker = Factory::create();
        $this->actingAs(User::first());
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
        $postParams = $this->postParams();
        $response = $this->post('/system/permissions', $postParams);

        $permission = Permission::whereName($postParams['name'])->first();

        $response->assertStatus(200)
            ->assertJsonFragment([
            'message' => 'The permission was created!',
            'redirect'=> '/system/permissions/'.$permission->id.'/edit',
        ]);
    }

    /** @test */
    public function edit()
    {
        $permission = Permission::create($this->postParams());
        $permission = $permission->fresh();
        $permission->roleList;

        $response = $this->get('/system/permissions/'.$permission->id.'/edit');

        $response->assertStatus(200);
        $response->assertViewHas('form');
    }

    /** @test */
    public function update()
    {
        $permission = Permission::create($this->postParams());
        $permission->description = 'edited';
        $permission->_method = 'PATCH';

        $response = $this->patch('/system/permissions/'.$permission->id, $permission->toArray())
            ->assertStatus(200)
            ->assertJson(['message' => __(config('labels.savedChanges'))]);

        $this->assertTrue($permission->fresh()->description === 'edited');
    }

    /** @test */
    public function destroy()
    {
        $permission = Permission::create($this->postParams());

        $response = $this->delete('/system/permissions/'.$permission->id);

        $response->assertJsonFragment(['message']);
        $this->assertNull($permission->fresh());
        $response->assertStatus(200);
    }

    /** @test */
    public function cant_destroy_if_has_roles()
    {
        $permission = Permission::create($this->postParams());
        $role = Role::first(['id']);
        $permission->roles()->attach($role->id);

        $response = $this->delete('/system/permissions/'.$permission->id);

        $response->assertStatus(302);
        $this->assertTrue(session('flash_notification')[0]->level === 'danger');
        $this->assertNotNull($permission->fresh());
    }

    private function postParams()
    {
        return [
            'permission_group_id'   => PermissionGroup::first(['id'])->id,
            'name'                  => $this->faker->word,
            'description'           => $this->faker->sentence,
            'type'                  => 0,
            'default'               => 0,
            '_method'               => 'POST',
        ];
    }
}
