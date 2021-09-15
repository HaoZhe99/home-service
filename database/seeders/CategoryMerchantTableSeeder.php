<?php

namespace Database\Seeders;

use App\Models\Merchant;
use Illuminate\Database\Seeder;

class CategoryMerchantTableSeeder extends Seeder
{
    public function run()
    {
        Merchant::findOrFail(1)->categories()->sync(1);
        Merchant::findOrFail(2)->categories()->sync(2);
    }
}
