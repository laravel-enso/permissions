<?php

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use LaravelEnso\Forms\TestTraits\CreateForm;
use LaravelEnso\Forms\TestTraits\DestroyForm;
use LaravelEnso\Forms\TestTraits\EditForm;
use LaravelEnso\Menus\Models\Menu;
use LaravelEnso\Permissions\Enums\Types;
use LaravelEnso\Permissions\Http\Middleware\VerifyRouteAccess;
use LaravelEnso\Permissions\Models\Permission;
use LaravelEnso\Roles\Models\Role;
use LaravelEnso\Tables\Traits\Tests\Datatable;
use LaravelEnso\Users\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    use CreateForm;
    use Datatable;
    use DestroyForm;
    use EditForm;
    use RefreshDatabase;

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

    #[Test]
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
                'param'    => ['permission' => $permission->id],
            ])->assertJsonStructure(['message']);
    }

    #[Test]
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

    #[Test]
    public function cant_destroy_if_has_roles()
    {
        $this->testModel->save();

        $this->testModel->roles()->attach(Role::first(['id']));

        $this->delete(route('system.permissions.destroy', $this->testModel->id, false))
            ->assertStatus(409);

        $this->assertNotNull($this->testModel->fresh());
    }

    #[Test]
    public function cant_destroy_if_permission_is_used_by_menu()
    {
        $this->testModel->save();

        Menu::factory()->create(['permission_id' => $this->testModel->id]);

        $this->delete(route('system.permissions.destroy', $this->testModel->id, false))
            ->assertStatus(409);

        $this->assertNotNull($this->testModel->fresh());
    }

    #[Test]
    public function get_option_list()
    {
        $this->testModel->save();

        $this->get(route('system.permissions.options', [
            'query' => $this->testModel->name,
            'limit' => 10,
        ], false))->assertStatus(200)
            ->assertJsonFragment(['name' => $this->testModel->name]);
    }

    #[Test]
    public function middleware_blocks_route_when_user_cannot_access_it()
    {
        $request = Request::create('/permission-test', 'GET');
        $request->setRouteResolver(fn () => new class() {
            public function getName(): string
            {
                return 'testing.permissions.denied';
            }
        });
        $request->setUserResolver(fn () => new class() {
            public function cannot(string $ability, string $route): bool
            {
                return $ability === 'access-route' && $route === 'testing.permissions.denied';
            }
        });

        $this->expectException(AuthorizationException::class);

        (new VerifyRouteAccess())->handle($request, fn () => response('ok'));
    }

    #[Test]
    public function middleware_allows_route_when_user_can_access_it()
    {
        $request = Request::create('/permission-test', 'GET');
        $request->setRouteResolver(fn () => new class() {
            public function getName(): string
            {
                return 'testing.permissions.allowed';
            }
        });
        $request->setUserResolver(fn () => new class() {
            public function cannot(): bool
            {
                return false;
            }
        });

        $response = (new VerifyRouteAccess())->handle($request, fn () => response('ok'));

        $this->assertSame('ok', $response->getContent());
    }

    #[Test]
    public function access_route_gate_uses_the_authenticated_user_model(): void
    {
        $permission = Permission::factory()->create([
            'name' => 'testing.permissions.gate',
        ]);
        $user = User::factory()->create();

        $user->role->permissions()->sync([$permission->id]);

        $this->assertTrue(Gate::forUser($user)->allows('access-route', $permission->name));
        $this->assertFalse(Gate::forUser($user)->allows('access-route', 'testing.permissions.missing'));
    }

    #[Test]
    public function determines_permission_type_from_menu_relation()
    {
        $this->testModel->save();
        Menu::factory()->create(['permission_id' => $this->testModel->id]);

        $this->assertSame(__(Types::Menu), $this->testModel->load('menu')->type());
    }

    #[Test]
    public function determines_permission_type_from_route_method()
    {
        Route::shouldReceive('getRoutes')->andReturn(new class() {
            public function getByName(string $name): object
            {
                return new class() {
                    public function methods(): array
                    {
                        return ['GET'];
                    }
                };
            }
        });

        $permission = Permission::factory()->make([
            'name' => 'system.permissions.index',
        ]);

        $this->assertSame('GET', $permission->method());
        $this->assertSame(Types::Read, $permission->type());
    }
}
