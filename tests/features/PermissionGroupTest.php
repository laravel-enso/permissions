<?php

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelEnso\FormBuilder\app\TestTraits\EditForm;
use LaravelEnso\FormBuilder\app\TestTraits\CreateForm;
use LaravelEnso\FormBuilder\app\TestTraits\DestroyForm;
use LaravelEnso\PermissionManager\app\Models\Permission;
use LaravelEnso\VueDatatable\app\Traits\Tests\Datatable;
use LaravelEnso\PermissionManager\app\Models\PermissionGroup;

class PermissionGroupTest extends TestCase
{
    use CreateForm, Datatable, DestroyForm, EditForm, RefreshDatabase;

    private $permissionGroup = 'system.permissionGroups';
    private $testModel;

    protected function setUp()
    {
        parent::setUp();

        // $this->withoutExceptionHandling();

        $this->seed()
            ->actingAs(User::first());

        $this->testModel = factory(PermissionGroup::class)
            ->make();
    }

    /** @test */
    public function can_store_permission_group()
    {
        $response = $this->post(
            route('system.permissionGroups.store', [], false),
            $this->testModel->toArray()
        );

        $group = PermissionGroup::whereName($this->testModel->name)
            ->first();

        $response->assertStatus(200)
            ->assertJsonFragment([
                'redirect' => 'system.permissionGroups.edit',
                'id' => $group->id,
            ])->assertJsonStructure([
                'message'
            ]);
    }

    /** @test */
    public function can_update_permission_group()
    {
        $this->testModel->save();

        $this->testModel->description = 'edited';

        $this->patch(route('system.permissionGroups.update', $this->testModel->id, false), $this->testModel->toArray())
            ->assertStatus(200)
            ->assertJsonStructure(['message']);

        $this->assertEquals('edited', $this->testModel->fresh()->description);
    }

    /** @test */
    public function cant_destroy_if_has_permission()
    {
        $this->testModel->save();
        $this->testModel->permissions()
            ->save(factory(Permission::class)->make());

        $this->delete(route('system.permissionGroups.destroy', $this->testModel->id, false))
            ->assertStatus(409);

        $this->assertNotNull($this->testModel->fresh());
    }
}
