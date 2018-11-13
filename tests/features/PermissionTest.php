<?php

use Faker\Factory;
use Tests\TestCase;
use LaravelEnso\Core\app\Models\User;
use LaravelEnso\RoleManager\app\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelEnso\FormBuilder\app\TestTraits\EditForm;
use LaravelEnso\FormBuilder\app\TestTraits\CreateForm;
use LaravelEnso\FormBuilder\app\TestTraits\DestroyForm;
use LaravelEnso\PermissionManager\app\Models\Permission;
use LaravelEnso\VueDatatable\app\Traits\Tests\Datatable;

class PermissionTest extends TestCase
{
    use CreateForm, Datatable, DestroyForm, EditForm, RefreshDatabase;

    private $permissionGroup = 'system.permissions';
    private $testModel;

    protected function setUp()
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
            ])->assertJsonStructure([
                'message',
            ]);
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

        $this->assertEquals('edited', $this->testModel->fresh()->description);
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
