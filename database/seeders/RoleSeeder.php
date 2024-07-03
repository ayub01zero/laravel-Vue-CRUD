<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'Administrator']);
        $admin->permissions()->attach(Permission::pluck('id'));
 
        $editor = Role::create(['name' => 'Editor']);
        $editor->permissions()->attach(
            Permission::where('name', '!=', 'posts.delete')->pluck('id')
        );
    }
}
