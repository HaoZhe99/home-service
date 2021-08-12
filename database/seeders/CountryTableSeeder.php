<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountryTableSeeder extends Seeder
{
    public function run()
    {
        $countries = [
            [
                'id' => 1,
                'country' => 'Malaysia',
            ],
        ];

        Country::insert($countries);
    }
}
