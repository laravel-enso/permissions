<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelEnso\Forms\TestTraits\CreateForm;
use LaravelEnso\Forms\TestTraits\DestroyForm;
use LaravelEnso\Forms\TestTraits\EditForm;
use LaravelEnso\Permissions\Models\Permission;
use LaravelEnso\Roles\Models\Role;
use LaravelEnso\Tables\Traits\Tests\Datatable;
use LaravelEnso\Users\Models\User;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    use CreateForm, Datatable, DestroyForm, EditForm, RefreshDatabase;

    private $permissionGroup = 'system.permissions';
    private $testModel;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed()
            ->actingAs(User::first());

        $this->testModel = Permission::factory()
            ->make();
    }

    /** @test */
    public function can_store_permission()
    {
        $response = $this->post(
            route('system.permissions.store'),
            $this->testModel->toArray() + ['roles' => []]
        );

        $permission = Permission::whereName($this->testModel->name)
            ->first();

        $response->assertStatus(200)
            ->assertJsonFragment([
                'redirect' => 'system.permissions.edit',
                'param' => ['permission' => $permission->id],
            ])->assertJsonStructure(['message']);
    }

    /** @test */
    public function can_update_permission()
    {
        $this->testModel->save();

        $this->testModel->description = 'edited';

        $this->patch(
            route('system.permissions.update', $this->testModel->id, false),
            $this->testModel->toArray() + ['roles' => []]
        )->assertStatus(200)
            ->assertJsonStructure(['message']);

        $this->assertEquals($this->testModel->description, $this->testModel->fresh()->description);
    }

    /** @test */
    public function cant_destroy_if_has_roles()
    {
        $this->testModel->save();

        $this->testModel->roles()->attach(Role::first(['id']));

        $this->delete(route('system.permissions.destroy', $this->testModel->id, false))
            ->assertStatus(409);

        $this->assertNotNull($this->testModel->fresh());
    }
}
