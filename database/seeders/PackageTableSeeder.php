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
                'name'          => 'SIGNATURE BOX - CLASSIC',
                'price'         => '15.99',
                'status'        => 'active',
                'description'   => 'Zinger Classic, 1 piece of chicken, fries, drink.',
                'merchant_id'   => 1,  
            ],
            [
                'id'            => 2,
                'name'          => 'CHEEZILLA BOX',
                'price'         => '21.99',
                'status'        => 'active',
                'description'   => 'Zinger Cheezilla, 1 piece of chicken, fries, drink.',
                'merchant_id'   => 1, 
            ],
            [
                'id'            => 3,
                'name'          => 'Filet-O-Fish Medium Set',
                'price'         => '13.49',
                'status'        => 'active',
                'description'   => 'Filet-O-Fish, French Fries, Coca-Cola.',
                'merchant_id'   => 2, 
            ],
            [
                'id'            => 4,
                'name'          => 'Spicy Chicken McDeluxe Medium Set',
                'price'         => '17.26',
                'status'        => 'active',
                'description'   => 'Spicy Chicken McDeluxe, French Fries, Coca-Cola.',
                'merchant_id'   => 2, 
            ],
        ];

        Package::insert($package);
    }
}
