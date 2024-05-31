<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user_seed = [
            [
                'id'           => 1,
                'email'        => "admin@gmail.com",
                'name'         => "ADMIN",
                'password'     => Hash::make('password'),
                'icno'         => "000000000000",
                'gender'       => "Male",
                'dob'          => "2002-12-02",
                'phone_number' => "0122301164",
                'address'      => "NO 35, LORONG BURGER 96, TAMAN BURGER SATU",
                'state'        => "Pahang",
                'postcode'     => "25300",
                'about'        => "",
                'role_id'      => 1,
            ],
            [
                'id'           => 2,
                'email'        => "moderator@gmail.com",
                'name'         => "MODERATOR",
                'password'     => Hash::make('password'),
                'icno'         => "000000000000",
                'gender'       => "Female",
                'dob'          => "2002-12-02",
                'phone_number' => "0122301164",
                'address'      => "NO 35, LORONG BURGER 96, TAMAN BURGER SATU",
                'state'        => "Pahang",
                'postcode'     => "25300",
                'about'        => "",
                'role_id'      => 2,
            ],
            [
                'id'           => 3,
                'email'        => "volunteer@gmail.com",
                'name'         => "VOLUNTEER",
                'password'     => Hash::make('password'),
                'icno'         => "000000000000",
                'gender'       => "Male",
                'dob'          => "2002-12-02",
                'phone_number' => "0122301164",
                'address'      => "NO 35, LORONG BURGER 96, TAMAN BURGER SATU",
                'state'        => "Pahang",
                'postcode'     => "25300",
                'about'        => "",
                'role_id'      => 3,
            ]
        ];

        foreach ($user_seed as $user_seed) {
            User::firstOrCreate($user_seed);
        }
    }
}
