<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageTableSeeder extends Seeder
{
    public function run()
    {
        $package = [
            [
                'id'            => 1,
                'name'          => 'Carpark Cleaning',
                'price'         => '39',
                'status'        => 'active',
                'description'   => 'Deeper Cleaning',
                'merchant_id'   => 1,
            ],
            [
                'id'            => 2,
                'name'          => 'Living Room Cleaning',
                'price'         => '49',
                'status'        => 'active',
                'description'   => 'Change Sheet, Wipping Floor, Deeper Cleaning',
                'merchant_id'   => 1,
            ],
            [
                'id'            => 3,
                'name'          => 'Aircon Service',
                'price'         => '99',
                'status'        => 'active',
                'description'   => 'Surface Cleaning, Deep Cleaning, Repair',
                'merchant_id'   => 2,
            ],
            [
                'id'            => 4,
                'name'          => 'Aircon Installation',
                'price'         => '59',
                'status'        => 'active',
                'description'   => 'Aircon Install, Wayar Install, Aircon Motor Install',
                'merchant_id'   => 2,
            ],
        ];

        Package::insert($package);
    }
}
