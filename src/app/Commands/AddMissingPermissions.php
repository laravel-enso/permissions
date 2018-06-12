<?php

namespace LaravelEnso\PermissionManager\app\Commands;

use Illuminate\Console\Command;
use LaravelEnso\RoleManager\app\Models\Role;
use LaravelEnso\PermissionManager\app\Models\Permission;
use LaravelEnso\PermissionManager\app\Models\PermissionGroup;

class AddMissingPermissions extends Command
{
    protected $signature = 'enso:add-missing-permissions';

    protected $description = 'This command will add the missing permissions for the new frontend middleware "allow"';

    private $permissionIds;

    public function handle()
    {
        $this->permissionIds = collect();

        $this->addSystemMenusIndex();
        $this->addSystemRolesConfigure();

        $this->attachToAdmin();
    }

    private function addSystemMenusIndex()
    {
        $permission = Permission::whereName('system.menus.index')->first();

        if ($permission) {
            $this->info('"system.menus.index" already exists');

            return;
        }

        $group = PermissionGroup::whereName('system.menus')->first();
        if (!$group) {
            $this->warning('"system.menus" is missing!!!');

            return;
        }

        $permission = Permission::create([
            'permission_group_id' => $group->id,
            'name' => 'system.menus.index',
            'description' => 'Menus index',
            'type' => 0,
            'is_default' => false,
        ]);

        $this->permissionIds->push($permission->id);

        $this->info('"system.menus.index" was successfully added');
    }

    private function addSystemRolesConfigure()
    {
        $permission = Permission::whereName('system.roles.configure')->first();

        if ($permission) {
            $this->info('"system.roles.configure" already exists');

            return;
        }

        $group = PermissionGroup::whereName('system.roles')->first();
        if (!$group) {
            $this->warning('"system.roles" is missing!!!');

            return;
        }

        $permission = Permission::create([
            'permission_group_id' => $group->id,
            'name' => 'system.roles.configure',
            'description' => 'Configure role permissions',
            'type' => 1,
            'is_default' => false,
        ]);

        $this->permissionIds->push($permission->id);

        $this->info('"system.roles.configure" was successfully added');
    }

    private function attachToAdmin()
    {
        $role = Role::first();
        $role->permissions()->attach($this->permissionIds);

        $this->info('The new permissions were attached to the "admin" role');
    }
}
