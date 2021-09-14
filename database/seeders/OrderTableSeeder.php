<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    public function run()
    {
        $order = [
            [
                'id'            => 1,
                'price'         => '15.99',
                'status'        => 'approved',
                'comment'       => 'Good Taste',
                'rate'          => '5',
                'remark'        => '',
                'merchant_id'   => 1,
                'package_id'    => 1,
                'user_id'       => 4,
                'servicer_id'   => 1,
                'qr_code_id'    => 1,
            ],
            [
                'id'            => 2,
                'price'         => '17.26',
                'status'        => 'approved',
                'comment'       => 'Good Taste',
                'rate'          => '5',
                'remark'        => '',
                'merchant_id'   => 2,
                'package_id'    => 4,
                'user_id'       => 4,
                'servicer_id'   => 2,
                'qr_code_id'    => 2,
            ],
        ];

        Order::insert($order);
    }
}
