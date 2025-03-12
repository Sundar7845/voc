<?php

namespace Database\Seeders;

use App\Models\Branches;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'branch_name' => 'Anna nagar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'branch_name' => 'Puducherry',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'branch_name' => 'Vellore',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'branch_name' => 'Hosur',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'branch_name' => 'Trichy',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'branch_name' => 'Salem',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'branch_name' => 'Erode',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'branch_name' => 'Coimbatore',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'branch_name' => 'Experience center',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'branch_name' => 'Pollachi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'branch_name' => 'Udumalpet',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'branch_name' => 'Madurai',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'branch_name' => 'Ramnad',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        Branches::insert($data);
    }
}
