<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AddressUserTableSeeder extends Seeder
{
    public function run()
    {
        User::findOrFail(4)->addresses()->sync(2);
    }
}
