<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = 'Admin';
        $user->username = 'admin';
        $user->email = 'admin@admin.com';
        $user->phone = '01794973738';
        $user->password = Hash::make('admin');
        $user->save();
        $user->assignRole('Super Admin');
    }
}
