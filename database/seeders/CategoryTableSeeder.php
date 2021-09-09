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
                'name' => 'Pest control',
            ],
            [
                'id' => 4,
                'name' => 'Mover & Relocators',
            ],
            [
                'id' => 5,
                'name' => 'Computer service',
            ],
            [
                'id' => 6,
                'name' => 'Interior design ',
            ],
            [
                'id' => 7,
                'name' => 'Light & wiring',
            ],
        ];

        Category::insert($categories);
    }
}
