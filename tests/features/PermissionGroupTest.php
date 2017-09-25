<?php

use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use LaravelEnso\PermissionManager\app\Models\Permission;
use LaravelEnso\PermissionManager\app\Models\PermissionGroup;
use LaravelEnso\TestHelper\app\Classes\TestHelper;
use LaravelEnso\TestHelper\app\Classes\Traits\TestCreateForm;
use LaravelEnso\TestHelper\app\Classes\Traits\TestDataTable;

class PermissionGroupTest extends TestHelper
{
    use DatabaseMigrations, TestDataTable, TestCreateForm;

    private $faker;
    private $prefix = 'system.permissionGroups';

    protected function setUp()
    {
        parent::setUp();

        $this->disableExceptionHandling();
        $this->faker = Factory::create();
        $this->signIn(User::first());
    }

    /** @test */
    public function store()
    {
        $postParams = $this->postParams();
        $response = $this->post(route('system.permissionGroups.store', [], false), $postParams);

        $group = PermissionGroup::whereName($postParams['name'])->first();

        $response->assertStatus(200)
            ->assertJson([
                'message'  => 'The permission group was created!',
                'redirect' => '/system/permissionGroups/'.$group->id.'/edit',
            ]);
    }

    /** @test */
    public function edit()
    {
        $group = PermissionGroup::create($this->postParams());

        $this->get(route('system.permissionGroups.edit', $group->id, false))
            ->assertStatus(200)
            ->assertJsonStructure(['form']);
    }

    /** @test */
    public function update()
    {
        $group = PermissionGroup::create($this->postParams());
        $group->description = 'edited';

        $this->patch(route('system.permissionGroups.update', $group->id, false), $group->toArray())
            ->assertStatus(200)
            ->assertJson(['message' => __(config('enso.labels.savedChanges'))]);

        $this->assertEquals('edited', $group->fresh()->description);
    }

    /** @test */
    public function destroy()
    {
        $group = PermissionGroup::create($this->postParams());

        $this->delete(route('system.permissionGroups.destroy', $group->id, false))
            ->assertStatus(200)
            ->assertJsonStructure(['message', 'redirect']);

        $this->assertNull($group->fresh());
    }

    /** @test */
    public function cant_destroy_if_has_permission()
    {
        $group = PermissionGroup::create($this->postParams());
        $this->addPermission($group);

        $this->expectException(EnsoException::class);

        $this->delete(route('system.permissionGroups.destroy', $group->id, false))
            ->assertStatus(302);

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
