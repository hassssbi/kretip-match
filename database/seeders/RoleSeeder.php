<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_seed = [
            ['id' => '1', 'name' => 'ADMIN'],
            ['id' => '2', 'name' => 'MODERATOR'],
            ['id' => '3', 'name' => 'VOLUNTEER'],
        ];

        foreach ($role_seed as $role_seed) {
            Role::firstOrCreate($role_seed);
        }
    }
}
