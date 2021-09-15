<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            CountryTableSeeder::class,
            PaymentMethodTableSeeder::class,
            StateTableSeeder::class,
            CategoryTableSeeder::class,
            AddressTableSeeder::class,
            MerchantTableSeeder::class,
            CategoryMerchantTableSeeder::class,
            PackageTableSeeder::class,
            QRCodeTableSeeder::class,
            ServicerTableSeeder::class,
            OrderTableSeeder::class,
            EbillingTableSeeder::class,
        ]);
    }
}
