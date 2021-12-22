<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Order;
use App\Models\State;
use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    public function run()
    {
        $a = Address::inRandomOrder()->first();

        $s = State::where('id',$a->state_id)->first();

        $order = [
            [
                'id'            => 1,
                'price'         => '39',
                'status'        => 'incomplete',
                'comment'       => null,
                'rate'          => null,
                'date' =>'2021-11-29',
                'time' =>'11:20',
                'address'=>$a->address.','.$s->area.','.$s->postcode.','.$s->state,
                'remark'        => '',
                'merchant_id'   => 1,
                'package_id'    => 1,
                'user_id'       => 4,
                'servicer_id'   => 1,
            ],
            [
                'id'            => 2,
                'price'         => '59',
                'status'        => 'completed',
                'comment'       => null,
                'rate'          => null,
                'date' =>'2021-11-05',
                'time' =>'17:20',
                'address'=>$a->address.','.$s->area.','.$s->postcode.','.$s->state,
                'remark'        => '',
                'merchant_id'   => 2,
                'package_id'    => 4,
                'user_id'       => 4,
                'servicer_id'   => 1,
            ],
        ];

        Order::insert($order);
    }
}
