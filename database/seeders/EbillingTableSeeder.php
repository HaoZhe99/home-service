<?php

namespace Database\Seeders;

use App\Models\Ebilling;
use Illuminate\Database\Seeder;

class EbillingTableSeeder extends Seeder
{
    public function run()
    {
        $ebilling = [
            [
                'id'                => 1,
                'money'             => '39',
                'status'            => 'approved',
                'remark'            => '',
                'order_id'          => 1,
                'user_id'           => 4,
                'payment_method_id' => 1,
            ],
            [
                'id'                => 2,
                'money'             => '59',
                'status'            => 'approved',
                'remark'            => '',
                'order_id'          => 2,
                'user_id'           => 4,
                'payment_method_id' => 2,
            ],
        ];

        Ebilling::insert($ebilling);
    }
}
