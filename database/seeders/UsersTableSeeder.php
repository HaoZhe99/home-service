<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('password'),
                'username'       => 'admin',
                'phone'          => '+60025788945',
                'verify'         => 1,
            ],
            [
                'id'             => 2,
                'name'           => 'Merchant 01',
                'email'          => 'm1@m.com',
                'password'       => bcrypt('password'),
                'username'       => 'Merchant 01',
                'phone'          => '+6047242234',
                'verify'         => 1,
            ],
            [
                'id'             => 3,
                'name'           => 'Merchant 02',
                'email'          => 'm2@m.com',
                'password'       => bcrypt('password'),
                'username'       => 'Merchant 02',
                'phone'          => '+604724242234',
                'verify'         => 1,
            ],
            [
                'id'             => 4,
                'name'           => 'User',
                'email'          => 'user@user.com',
                'password'       => bcrypt('password'),
                'username'       => 'User',
                'phone'          => '+6047242453',
                'verify'         => 1,
            ],
            [
                'id'             => 5,
                'name'           => 'Servicer 01',
                'email'          => 's@s.com',
                'password'       => bcrypt('password'),
                'username'       => 'Servicer 01',
                'phone'          => '+235434135',
                'verify'         => 1,
            ],
            [
                'id'             => 6,
                'name'           => 'Servicer 02',
                'email'          => 's2@s.com',
                'password'       => bcrypt('password'),
                'username'       => 'Servicer 02',
                'phone'          => '+235434135',
                'verify'         => 1,
            ],
        ];

        User::insert($users);
    }
}
