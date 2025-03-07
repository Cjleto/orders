<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $initial_role_permissions = config('myconst.initial_role_permissions');

        foreach ($initial_role_permissions as $role => $permissions) {
            $new_role = Role::create(['name' => $role]);
            $new_role->permissions()->detach();
            foreach ($permissions as $permission) {
                $new_permission = Permission::updateOrCreate(['name' => $permission]);
                $new_role->permissions()->attach($new_permission->id);
            }
        }

    }
}
