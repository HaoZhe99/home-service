<?php

namespace Database\Seeders;

use App\Models\Merchant;
use Illuminate\Database\Seeder;

class CategoryMerchantTableSeeder extends Seeder
{
    public function run()
    {
        Merchant::findOrFail(1)->categories()->sync(1);
        Merchant::findOrFail(2)->categories()->sync(1);
        Merchant::findOrFail(3)->categories()->sync(1);
        Merchant::findOrFail(4)->categories()->sync(3);
        Merchant::findOrFail(5)->categories()->sync(3);
        Merchant::findOrFail(6)->categories()->sync(3);
        Merchant::findOrFail(7)->categories()->sync(4);
        Merchant::findOrFail(8)->categories()->sync(4);
        Merchant::findOrFail(9)->categories()->sync(4);
        Merchant::findOrFail(10)->categories()->sync(5);
        Merchant::findOrFail(11)->categories()->sync(5);
        Merchant::findOrFail(12)->categories()->sync(5);
        Merchant::findOrFail(13)->categories()->sync(6);
        Merchant::findOrFail(14)->categories()->sync(6);
        Merchant::findOrFail(15)->categories()->sync(6);
        Merchant::findOrFail(16)->categories()->sync(2);
        Merchant::findOrFail(17)->categories()->sync(2);
    }
}
