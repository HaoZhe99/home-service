<?php

namespace Database\Seeders;

use App\Models\Merchant;
use Illuminate\Database\Seeder;

class MerchantTableSeeder extends Seeder
{
    public function run()
    {
        $merchant = [
            [
                'id'               => 1,
                'name'             => 'Home Cleaning Enterprises',
                'description'      => 'Home cleaning, Toliet Cleaning, Bedroom Cleaning, Living Room Cleaning, Carpark Cleaning.',
                'contact_number'   => '+604343541638',
                'status'           => 'approved',
                'address'          => '34, Jalan Sini 56, Taman University',
                'state_id'         => 79,
                'longitude'        => '1.563032',
                'latitude'         => '103.60145468',
                'ssm_number'       => '11232313-T',
            ],
            [
                'id'               => 2,
                'name'             => 'Aircon Services Company',
                'description'      => 'Install Aircon, Washing Aircon, Service Aircon',
                'contact_number'   => '+60245ddd4',
                'status'           => 'approved',
                'address'          => '888, Jalan Impian 34, Taman Impian Emas',
                'state_id'         => 79,
                'longitude'        => '1.5630422',
                'latitude'         => '103.64015468',
                'ssm_number'       => '435465-T',
            ],
        ];

        Merchant::insert($merchant);
    }
}
