<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['guard_name'=>'web','name'=>'user-index','group_name'=>'Users Permission']);
        Permission::create(['guard_name'=>'web','name'=>'user-create','group_name'=>'Users Permission']);
        Permission::create(['guard_name'=>'web','name'=>'user-update','group_name'=>'Users Permission']);
        Permission::create(['guard_name'=>'web','name'=>'user-delete','group_name'=>'Users Permission']);
        Permission::create(['guard_name'=>'web','name'=>'role-permission-index','group_name'=>'Roles And Permissions']);
        Permission::create(['guard_name'=>'web','name'=>'role-permission-create','group_name'=>'Roles And Permissions']);
        Permission::create(['guard_name'=>'web','name'=>'role-permission-update','group_name'=>'Roles And Permissions']);
        Permission::create(['guard_name'=>'web','name'=>'role-permission-delete','group_name'=>'Roles And Permissions']);

    }
}
