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
                'name'             => 'KFC',
                'description'      => 'Fastfood Restaurant',
                'contact_number'   => '+604343541638',
                'status'           => 'approved',
                'address'          => 'Lot LG15, Jaya Jusco Taman University Shopping Center',
                'state_id'         => 79,
                'longitude'        => '1.563022',
                'latitude'         => '103.6015468',
                'ssm_number'       => '11232313-T',
            ],
            [
                'id'               => 2,
                'name'             => 'Macdonald',
                'description'      => 'Fastfood Restaurant',
                'contact_number'   => '+602454',
                'status'           => 'approved',
                'address'          => 'LG08, Jusco Shopping Center, No. 4, Jalan Pendidikan, Taman Universiti',
                'state_id'         => 79,
                'longitude'        => '1.563022',
                'latitude'         => '103.6015468',
                'ssm_number'       => '435465-T',
            ],
        ];

        Merchant::insert($merchant);
    }
}
