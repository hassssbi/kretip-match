<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        /* User::factory()->create([
            'id'       => 1,
            'email'    => "admin@gmail.com",
            'name'     => "ADMIN",
            'icno'     => "000000-00-0000",
            'gender'   => "M",
            'dob'      => "2002-12-02",
            'phoneno'  => "0122301164",
            'address'  => "NO 35, LORONG BURGER 96, TAMAN BURGER SATU",
            'state'    => "Pahang",
            'postcode' => "25300",
            'role_id'  => 1,
        ]); */
    }
}
