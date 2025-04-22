<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'superadmin',
                'role_id' => 1,
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'admin',
                'role_id' => 2,
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'anna_nagar',
                'role_id' => 3,
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'puducherrey',
                'role_id' => 3,
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'vellore',
                'role_id' => 3,
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'hosur',
                'role_id' => 3,
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'trichy',
                'role_id' => 3,
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'salem',
                'role_id' => 3,
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'erode',
                'role_id' => 3,
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'coimbatore',
                'role_id' => 3,
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'experience_center',
                'role_id' => 3,
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'pollachi',
                'role_id' => 3,
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'udumalpet',
                'role_id' => 3,
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'madurai',
                'role_id' => 3,
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'ramnad',
                'role_id' => 3,
                'password' => Hash::make('123456')
            ],
        ];


        // Insert users into the database
        foreach ($user as $user) {
            User::create($user);
        }
    }
}
