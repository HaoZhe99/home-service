<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodTableSeeder extends Seeder
{
    public function run()
    {
        $payment_method = [
            [
                'id'             => 1,
                'name'           => 'Online Transfer',
                'status'          => 'active',
            ],
            [
                'id'             => 2,
                'name'           => 'Debit/Credit card',
                'status'          => 'active',
            ],
        ];

        PaymentMethod::insert($payment_method);
    }
}
