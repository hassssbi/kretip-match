<?php

namespace Database\Seeders;

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
        $users = [
            // Admins
            [
                'email'        => "admin@gmail.com",
                'name'         => "ADMIN ONE",
                'password'     => Hash::make('password'),
                'icno'         => "000000000001",
                'gender'       => "Male",
                'dob'          => "2000-01-01",
                'phone_number' => "0123456781",
                'address'      => "NO 1, LORONG ADMIN, TAMAN ADMIN",
                'state'        => "Pahang",
                'postcode'     => "25100",
                'about'        => "Admin One description",
                'role_id'      => 1,
            ],
            [
                'email'        => "admin2@gmail.com",
                'name'         => "ADMIN TWO",
                'password'     => Hash::make('password'),
                'icno'         => "000000000002",
                'gender'       => "Female",
                'dob'          => "2001-01-01",
                'phone_number' => "0123456782",
                'address'      => "NO 2, LORONG ADMIN, TAMAN ADMIN",
                'state'        => "Pahang",
                'postcode'     => "25200",
                'about'        => "Admin Two description",
                'role_id'      => 1,
            ],
            // Moderators
            [
                'email'        => "moderator@gmail.com",
                'name'         => "MODERATOR ONE",
                'password'     => Hash::make('password'),
                'icno'         => "000000000003",
                'gender'       => "Male",
                'dob'          => "2002-01-01",
                'phone_number' => "0123456783",
                'address'      => "NO 3, LORONG MODERATOR, TAMAN MODERATOR",
                'state'        => "Pahang",
                'postcode'     => "25300",
                'about'        => "Moderator One description",
                'role_id'      => 2,
            ],
            [
                'email'        => "moderator2@gmail.com",
                'name'         => "MODERATOR TWO",
                'password'     => Hash::make('password'),
                'icno'         => "000000000004",
                'gender'       => "Female",
                'dob'          => "2003-01-01",
                'phone_number' => "0123456784",
                'address'      => "NO 4, LORONG MODERATOR, TAMAN MODERATOR",
                'state'        => "Pahang",
                'postcode'     => "25400",
                'about'        => "Moderator Two description",
                'role_id'      => 2,
            ],
            [
                'email'        => "moderator3@gmail.com",
                'name'         => "MODERATOR THREE",
                'password'     => Hash::make('password'),
                'icno'         => "000000000005",
                'gender'       => "Male",
                'dob'          => "2004-01-01",
                'phone_number' => "0123456785",
                'address'      => "NO 5, LORONG MODERATOR, TAMAN MODERATOR",
                'state'        => "Pahang",
                'postcode'     => "25500",
                'about'        => "Moderator Three description",
                'role_id'      => 2,
            ],
            // Volunteers
            [
                'email'        => "volunteer@gmail.com",
                'name'         => "VOLUNTEER ONE",
                'password'     => Hash::make('password'),
                'icno'         => "000000000006",
                'gender'       => "Female",
                'dob'          => "2005-01-01",
                'phone_number' => "0123456786",
                'address'      => "NO 6, LORONG VOLUNTEER, TAMAN VOLUNTEER",
                'state'        => "Pahang",
                'postcode'     => "25600",
                'about'        => "Volunteer One description",
                'role_id'      => 3,
            ],
            [
                'email'        => "volunteer2@gmail.com",
                'name'         => "VOLUNTEER TWO",
                'password'     => Hash::make('password'),
                'icno'         => "000000000007",
                'gender'       => "Male",
                'dob'          => "2006-01-01",
                'phone_number' => "0123456787",
                'address'      => "NO 7, LORONG VOLUNTEER, TAMAN VOLUNTEER",
                'state'        => "Pahang",
                'postcode'     => "25700",
                'about'        => "Volunteer Two description",
                'role_id'      => 3,
            ],
            [
                'email'        => "volunteer3@gmail.com",
                'name'         => "VOLUNTEER THREE",
                'password'     => Hash::make('password'),
                'icno'         => "000000000008",
                'gender'       => "Female",
                'dob'          => "2007-01-01",
                'phone_number' => "0123456788",
                'address'      => "NO 8, LORONG VOLUNTEER, TAMAN VOLUNTEER",
                'state'        => "Pahang",
                'postcode'     => "25800",
                'about'        => "Volunteer Three description",
                'role_id'      => 3,
            ],
            [
                'email'        => "volunteer4@gmail.com",
                'name'         => "VOLUNTEER FOUR",
                'password'     => Hash::make('password'),
                'icno'         => "000000000009",
                'gender'       => "Male",
                'dob'          => "2008-01-01",
                'phone_number' => "0123456789",
                'address'      => "NO 9, LORONG VOLUNTEER, TAMAN VOLUNTEER",
                'state'        => "Pahang",
                'postcode'     => "25900",
                'about'        => "Volunteer Four description",
                'role_id'      => 3,
            ],
            [
                'email'        => "volunteer5@gmail.com",
                'name'         => "VOLUNTEER FIVE",
                'password'     => Hash::make('password'),
                'icno'         => "000000000010",
                'gender'       => "Female",
                'dob'          => "2009-01-01",
                'phone_number' => "0123456790",
                'address'      => "NO 10, LORONG VOLUNTEER, TAMAN VOLUNTEER",
                'state'        => "Pahang",
                'postcode'     => "26000",
                'about'        => "Volunteer Five description",
                'role_id'      => 3,
            ],
        ];

        foreach ($users as $user_data) {
            User::firstOrCreate(['email' => $user_data['email']], $user_data);
        }
    }
}
