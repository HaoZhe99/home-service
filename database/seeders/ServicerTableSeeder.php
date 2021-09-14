<?php

namespace Database\Seeders;

use App\Models\Servicer;
use Illuminate\Database\Seeder;

class ServicerTableSeeder extends Seeder
{
    public function run()
    {
        $servicer = [
            [
                'id'            => 1,
                'name'          => 'Servicer 1',
                'user_id'       => 5,
                'merchant_id'   => 1,
            ],
            [
                'id'            => 2,
                'name'          => 'Servicer 2',
                'user_id'       => 5,
                'merchant_id'   => 2,
            ],
        ];

        Servicer::insert($servicer);
    }
}
