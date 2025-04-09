<?php

namespace Database\Seeders;

use App\Models\Profession;
use Illuminate\Database\Seeder;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $professions = [
            ['profession' => 'Doctor'],
            ['profession' => 'Teacher'],
            ['profession' => 'IT'],
            ['profession' => 'Business'],
            ['profession' => 'Employed In Govt'],
            ['profession' => 'Employed In Pvt'],
            ['profession' => 'Home Maker'],
            ['profession' => 'Others'],
        ];

        foreach ($professions as $profession) {
            Profession::create($profession);
        }
    }
}
