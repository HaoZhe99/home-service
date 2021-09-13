<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Seeder;

class AddressTableSeeder extends Seeder
{
    public function run()
    {
        $address = [
            [
                'id' => 1,
                'address' => '1, Jln Impian 100, Taman Impian Emas',
                'state_id' => 79,
            ],
            [
                'id' => 2,
                'address' => '23, Jln Kempas 55, Taman Kempas',
                'state_id' => 79,
            ],
            [
                'id' => 3,
                'address' => '77, Jln Indah 88, Taman Bukit Indah',
                'state_id' => 79,
            ],
            [
                'id' => 4,
                'address' => '67, Jln Austin 1/30, Taman Moust Austin',
                'state_id' => 79,
            ],
        ];

        Address::insert($address);
    }
}
