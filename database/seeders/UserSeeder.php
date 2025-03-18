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
                'name' => 'anna_nagar',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'puducherrey',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'vellore',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'hosur',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'trichy',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'salem',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'erode',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'coimbatore',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'experience_center',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'pollachi',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'udumalpet',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'madurai',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'ramnad',
                'password' => Hash::make('123456')
            ],
        ];


        // Insert users into the database
        foreach ($user as $user) {
            User::create($user);
        }
    }
}
