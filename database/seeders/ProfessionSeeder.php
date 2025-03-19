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
            ['profession' => 'Information Technology'],
            ['profession' => 'Business'],
            ['profession' => 'Accountant'],
            ['profession' => 'Driver'],
            ['profession' => 'Builder']
        ];

        foreach ($professions as $profession) {
            Profession::create($profession);
        }
    }
}
