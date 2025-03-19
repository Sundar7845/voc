<?php

namespace Database\Seeders;

use App\Models\Qualification;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $educations = [
            ['qualification' => 'BSC'],
            ['qualification' => 'MBA'],
            ['qualification' => 'BCOM'],
            ['qualification' => 'CDF'],
            ['qualification' => 'VISCOM'],
            ['qualification' => 'BA']
        ];

        foreach ($educations as $education) {
            Qualification::Create($education);
        }
    }
}
