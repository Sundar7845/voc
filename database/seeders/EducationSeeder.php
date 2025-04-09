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
            ['qualification' => 'Schooling'],
            ['qualification' => 'Graduate'],
            ['qualification' => 'Post Graduate'],
            ['qualification' => 'Doctorate'],
        ];

        foreach ($educations as $education) {
            Qualification::Create($education);
        }
    }
}
