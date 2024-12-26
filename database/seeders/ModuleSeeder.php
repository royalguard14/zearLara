<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

  Module::create([
    'name' => 'Roles',
    'icon' => 'fa-users',
    'description' => 'Manage roles within the system and assign permissions to users.',
    'url' => 'roles.index'  // Using named route for roles index
]);

Module::create([
    'name' => 'Users',
    'icon' => 'fa-users',
    'description' => 'Manage individual users, their details, and roles within the system.',
    'url' => 'users.index'  // Using named route for users index
]);

Module::create([
    'name' => 'Modules',
    'icon' => 'fa-cogs',
    'description' => 'Configure and manage system modules and their settings.',
    'url' => 'modules.index'  // Using named route for settings index
]);

Module::create([
    'name' => 'Settings',
    'icon' => 'fa-cogs',
    'description' => 'Manage global system settings, including configurations and preferences.',
    'url' => 'settings.index'  // Using named route for settings index
]);

    }
}
