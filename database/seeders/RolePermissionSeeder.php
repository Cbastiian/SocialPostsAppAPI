<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        $roleJson = File::get('database/data/roles.json');
        $permissionJson = File::get('database/data/permissions.json');
        $roleData = json_decode($roleJson);
        $permissionData = json_decode($permissionJson);

        foreach ($roleData as $obj) {
            Role::create(['name' => $obj->name]);
        }

        foreach ($permissionData as $obj) {
            Permission::create(['name' => $obj->name]);
        }

        $roles = Role::all();

        foreach ($roles as $role) {

            switch ($role->name) {
                case 'admin':
                    Role::findByName($role->name)->givePermissionTo('query_reports', 'punish_reports');
                    break;
                case 'regular_user':
                    Role::findByName($role->name)->givePermissionTo('create_post', 'comment_post');
                    break;
            }
        }
    }
}
