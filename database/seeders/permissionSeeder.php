<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class permissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'Read_categories', 'guard_name' => 'user']);
        Permission::create(['name' => 'Create_categories', 'guard_name' => 'user']);
        Permission::create(['name' => 'Update_categories', 'guard_name' => 'user']);
        Permission::create(['name' => 'Delete_categories', 'guard_name' => 'user']);
    }
}
