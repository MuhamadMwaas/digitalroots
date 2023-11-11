<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission as ModelsPermission;
use Spatie\Permission\Models\Role as ModelsRole;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // , 'guard_name' => 'web'
        $adminRole = ModelsRole::create(['name' => 'admin']);
        $userRole = ModelsRole::create(['name' => 'user']);


        $permissions = ModelsPermission::pluck('id', 'id')->all();

        $adminRole->syncPermissions($permissions);

        $permissions = ModelsPermission::where('id', "=", 5)->get();
        $userRole->syncPermissions($permissions);
    }
}
