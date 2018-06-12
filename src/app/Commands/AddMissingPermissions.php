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

        $this->attachToAdmin();
    }

    private function addSystemMenusIndex()
    {
        $permission = Permission::whereName('system.menus.index')->first();

        if (!$permission) {
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
                'is_default' => false
            ]);

            $this->permissionIds->push($permission->id);

            $this->info('"system.menus.index" was successfully added');
        } else {
            $this->info('"system.menus.index" already exists');
        }
    }

    private function attachToAdmin()
    {
        $role = Role::first();
        $role->permissions()->attach($this->permissionIds);

        $this->info('The added permissions were attached to the "admin" role');
    }
}
