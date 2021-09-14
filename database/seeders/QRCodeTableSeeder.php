<?php

namespace Database\Seeders;

use App\Models\QrCode;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class QRCodeTableSeeder extends Seeder
{
    public function run()
    {
        $qrcode = [
            [
                'id'            => 1,
                'code'          => Str::random(10),
                'status'        => 'active',
                'expired_at'    => '2021-09-14 15:33:27',
            ],
            [
                'id'            => 2,
                'code'          => Str::random(10),
                'status'        => 'active',
                'expired_at'    => '2021-09-14 15:33:27',
            ],
        ];

        QrCode::insert($qrcode);
    }
}
