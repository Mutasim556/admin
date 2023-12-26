<?php

namespace Database\Seeders;

use App\Models\Language\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Language::create([
            'lang'=>'en',
            'name'=>'English',
            'slug'=>'en',
            'default'=>1,
            'status'=>1,
            'delete'=>0,
        ]);
    }
}
