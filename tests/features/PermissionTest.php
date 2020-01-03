<?php

use Tests\TestCase;
use LaravelEnso\Core\App\Models\User;
use LaravelEnso\Roles\App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelEnso\Permissions\App\Models\Permission;
use LaravelEnso\Forms\App\TestTraits\EditForm;
use LaravelEnso\Forms\App\TestTraits\CreateForm;
use LaravelEnso\Forms\App\TestTraits\DestroyForm;
use LaravelEnso\Tables\App\Traits\Tests\Datatable;

class PermissionTest extends TestCase
{
    use CreateForm, Datatable, DestroyForm, EditForm, RefreshDatabase;

    private $permissionGroup = 'system.permissions';
    private $testModel;

    protected function setUp(): void
    {
        parent::setUp();

        // $this->withoutExceptionHandling();

        $this->seed()
            ->actingAs(User::first());

        $this->testModel = factory(Permission::class)
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
