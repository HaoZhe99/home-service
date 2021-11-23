<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'id' => 1,
                'name' => 'Cleaning',
            ],
            [
                'id' => 2,
                'name' => 'Repair',
            ],
            [
                'id' => 3,
                'name' => 'Plumbing Repair',
            ],
            [
                'id' => 4,
                'name' => 'Aircon Repair',
            ],
            [
                'id' => 5,
                'name' => 'Electrical',
            ],
            [
                'id' => 6,
                'name' => 'Light & wiring',
            ],
        ];

        Category::insert($categories);
    }
}
