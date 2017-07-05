<?php

use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use LaravelEnso\PermissionManager\app\Models\Permission;
use LaravelEnso\PermissionManager\app\Models\PermissionGroup;
use Tests\TestCase;

class PermissionGroupTest extends TestCase
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
        $response = $this->get('/system/permissionGroups');

        $response->assertStatus(200);
    }

    /** @test */
    public function create()
    {
        $response = $this->get('/system/permissionGroups/create');

        $response->assertStatus(200);
    }

    /** @test */
    public function store()
    {
        $postParams = $this->postParams();
        $response = $this->post('/system/permissionGroups', $postParams);

        $permissionGroup = PermissionGroup::whereName($postParams['name'])->first();

        $response->assertRedirect('/system/permissionGroups/'.$permissionGroup->id.'/edit');
        $this->hasSessionConfirmation($response);
    }

    /** @test */
    public function edit()
    {
        $permissionGroup = PermissionGroup::first();

        $response = $this->get('/system/permissionGroups/'.$permissionGroup->id.'/edit');

        $response->assertStatus(200);
        $response->assertViewHas('permissionGroup', $permissionGroup);
    }

    /** @test */
    public function update()
    {
        $permissionGroup = PermissionGroup::first();
        $permissionGroup->description = 'edited';
        $data = $permissionGroup->toArray();
        $data['_method'] = 'PATCH';

        $response = $this->patch('/system/permissionGroups/'.$permissionGroup->id, $data);

        $response->assertStatus(302);
        $this->hasSessionConfirmation($response);
        $this->assertTrue($this->wasUpdated());
    }

    /** @test */
    public function destroy()
    {
        $postParams = $this->postParams();
        PermissionGroup::create($postParams);
        $permissionGroup = PermissionGroup::whereName($postParams['name'])->first();

        $response = $this->delete('/system/permissionGroups/'.$permissionGroup->id);

        $this->hasJsonConfirmation($response);
        $this->wasDeleted($permissionGroup);
        $response->assertStatus(200);
    }

    /** @test */
    public function cantDestroyIfHasPermission()
    {
        $postParams = $this->postParams();
        PermissionGroup::create($postParams);
        $permissionGroup = PermissionGroup::whereName($postParams['name'])->first();
        $this->addPermission($permissionGroup);

        $response = $this->delete('/system/permissionGroups/'.$permissionGroup->id);

        $response->assertStatus(302);
        $this->assertTrue($this->hasSessionWarningMessage());
        $this->wasNotDeleted($permissionGroup);
    }

    private function wasUpdated()
    {
        $permissionGroup = PermissionGroup::first(['description']);

        return $permissionGroup->description === 'edited';
    }

    private function wasDeleted($permissionGroup)
    {
        return $this->assertNull(PermissionGroup::whereName($permissionGroup->name)->first());
    }

    private function wasNotDeleted($permissionGroup)
    {
        return $this->assertNotNull(PermissionGroup::whereName($permissionGroup->name)->first());
    }

    private function hasSessionConfirmation($response)
    {
        return $response->assertSessionHas('flash_notification');
    }

    private function hasJsonConfirmation($response)
    {
        return $response->assertJsonFragment(['message']);
    }

    private function hasSessionWarningMessage()
    {
        return session('flash_notification')[0]->level === 'warning';
    }

    private function addPermission($permissionGroup)
    {
        $permission = new Permission([
            'permission_group_id'   => $permissionGroup->id,
            'name'                  => $this->faker->word,
            'description'           => $this->faker->sentence,
            'type'                  => 0,
            'default'               => 0,
        ]);
        $permission->save();
    }

    private function postParams()
    {
        return [
            'permission_group_id'   => PermissionGroup::first(['id'])->id,
            'name'                  => $this->faker->word,
            'description'           => $this->faker->sentence,
            '_method'               => 'POST',
        ];
    }
}
