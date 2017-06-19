<?php

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use LaravelEnso\PermissionManager\app\Models\Permission;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    use DatabaseMigrations;

    private $user;

    protected function setUp()
    {
        parent::setUp();
        $this->user = User::first();
        $this->be($this->user);
    }

    /** @test */
    public function get_index()
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
        $response->assertStatus(302);
        $this->assertTrue($this->permissionWasCreated());
    }

    /** @test */
    public function edit()
    {
        $id = Permission::first()->id;
        $response = $this->get('/system/permissions/'.$id.'/edit');
        $response->assertStatus(200);
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
        $this->assertTrue($this->permissionWasUpdated());
    }

    /** @test */
    public function destroy()
    {
        $postParams = $this->postParams();
        $this->post('/system/permissions', $postParams);
        $permission = Permission::whereName($postParams['name'])->first();
        $response = $this->delete('/system/permissions/'.$permission->id);
        $response->assertStatus(200);
    }

    private function postParams()
    {
        return [
            'permissions_grou_id'  => 1,
            'name'                 => 'testPermission',
            'description'          => 'testDescription',
            'type'                 => 0,
            '_method'              => 'POST',
        ];
    }

    private function permissionWasCreated()
    {
        $permission = Permission::where('name', 'testPermission')->first();

        return $permission->name === 'testPermission';
    }

    private function permissionWasUpdated()
    {
        $permission = Permission::first();

        return $permission->description === 'edited';
    }
}
