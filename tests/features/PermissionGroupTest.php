<?php

use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use LaravelEnso\PermissionManager\app\Models\Permission;
use LaravelEnso\PermissionManager\app\Models\PermissionGroup;
use LaravelEnso\TestHelper\app\Classes\TestHelper;

class PermissionGroupTest extends TestHelper
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
        $this->get('/system/permissionGroups')
            ->assertStatus(200)
            ->assertViewIs('laravel-enso/permissionmanager::permissionGroups.index');
    }

    /** @test */
    public function create()
    {
        $this->get('/system/permissionGroups/create')
            ->assertStatus(200)
            ->assertViewIs('laravel-enso/permissionmanager::permissionGroups.create')
            ->assertViewHas('form');
    }

    /** @test */
    public function store()
    {
        $postParams = $this->postParams();
        $response = $this->post('/system/permissionGroups', $postParams);

        $group = PermissionGroup::whereName($postParams['name'])->first();

        $response->assertStatus(200)
            ->assertJsonFragment([
                'message'  => 'The permission group was created!',
                'redirect' => '/system/permissionGroups/'.$group->id.'/edit',
            ]);
    }

    /** @test */
    public function edit()
    {
        $group = PermissionGroup::create($this->postParams());

        $this->get('/system/permissionGroups/'.$group->id.'/edit')
            ->assertStatus(200)
            ->assertViewIs('laravel-enso/permissionmanager::permissionGroups.edit')
            ->assertViewHas('form');
    }

    /** @test */
    public function update()
    {
        $group = PermissionGroup::create($this->postParams());
        $group->description = 'edited';

        $this->patch('/system/permissionGroups/'.$group->id, $group->toArray())
            ->assertStatus(200)
            ->assertJson(['message' => __(config('labels.savedChanges'))]);

        $this->assertEquals('edited', $group->fresh()->description);
    }

    /** @test */
    public function destroy()
    {
        $group = PermissionGroup::create($this->postParams());

        $this->delete('/system/permissionGroups/'.$group->id)
            ->assertStatus(200)
            ->assertJsonFragment(['message']);

        $this->assertNull($group->fresh());
    }

    /** @test */
    public function cant_destroy_if_has_permission()
    {
        $group = PermissionGroup::create($this->postParams());
        $this->addPermission($group);

        $this->delete('/system/permissionGroups/'.$group->id)
            ->assertStatus(302)
            ->assertSessionHas('flash_notification');

        $this->assertNotNull($group->fresh());
    }

    private function addPermission($group)
    {
        Permission::create([
            'permission_group_id' => $group->id,
            'name'                => $this->faker->word,
            'description'         => $this->faker->sentence,
            'type'                => 0,
            'default'             => 0,
        ]);
    }

    private function postParams()
    {
        return [
            'name'        => $this->faker->word,
            'description' => $this->faker->sentence,
            '_method'     => 'POST',
        ];
    }
}
