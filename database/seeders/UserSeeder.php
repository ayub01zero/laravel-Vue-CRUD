<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::factory()->create(['email' => 'admin@admin.com']);
        $admin->roles()->attach(Role::where('name', 'Administrator')->value('id'));
 
        $editor = User::factory()->create(['email' => 'editor@edit.com']);
        $editor->roles()->attach(Role::where('name', 'Editor')->value('id'));
    }
}
