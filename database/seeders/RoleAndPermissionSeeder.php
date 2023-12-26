<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['guard_name'=>'web','name'=>'role-permission-index','group_name'=>'Roles And Permissions']);
        Permission::create(['guard_name'=>'web','name'=>'role-permission-create','group_name'=>'Roles And Permissions']);
        Permission::create(['guard_name'=>'web','name'=>'role-permission-update','group_name'=>'Roles And Permissions']);
        Permission::create(['guard_name'=>'web','name'=>'role-permission-delete','group_name'=>'Roles And Permissions']);
    }
}
