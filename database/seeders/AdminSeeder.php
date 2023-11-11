<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role as ModelsRole;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => bcrypt('123456789'),
            'is_super' => 1,
            

        ]);
        $role = ModelsRole::Where('name', '=', 'admin')->first();
        $user->assignRole([$role->id]);
    }
}
