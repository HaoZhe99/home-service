<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'merchant_management_access',
            ],
            [
                'id'    => 18,
                'title' => 'category_create',
            ],
            [
                'id'    => 19,
                'title' => 'category_edit',
            ],
            [
                'id'    => 20,
                'title' => 'category_show',
            ],
            [
                'id'    => 21,
                'title' => 'category_delete',
            ],
            [
                'id'    => 22,
                'title' => 'category_access',
            ],
            [
                'id'    => 23,
                'title' => 'package_create',
            ],
            [
                'id'    => 24,
                'title' => 'package_edit',
            ],
            [
                'id'    => 25,
                'title' => 'package_show',
            ],
            [
                'id'    => 26,
                'title' => 'package_delete',
            ],
            [
                'id'    => 27,
                'title' => 'package_access',
            ],
            [
                'id'    => 28,
                'title' => 'merchant_create',
            ],
            [
                'id'    => 29,
                'title' => 'merchant_edit',
            ],
            [
                'id'    => 30,
                'title' => 'merchant_show',
            ],
            [
                'id'    => 31,
                'title' => 'merchant_delete',
            ],
            [
                'id'    => 32,
                'title' => 'merchant_access',
            ],
            [
                'id'    => 33,
                'title' => 'country_create',
            ],
            [
                'id'    => 34,
                'title' => 'country_edit',
            ],
            [
                'id'    => 35,
                'title' => 'country_show',
            ],
            [
                'id'    => 36,
                'title' => 'country_delete',
            ],
            [
                'id'    => 37,
                'title' => 'country_access',
            ],
            [
                'id'    => 38,
                'title' => 'state_create',
            ],
            [
                'id'    => 39,
                'title' => 'state_edit',
            ],
            [
                'id'    => 40,
                'title' => 'state_show',
            ],
            [
                'id'    => 41,
                'title' => 'state_delete',
            ],
            [
                'id'    => 42,
                'title' => 'state_access',
            ],
            [
                'id'    => 43,
                'title' => 'address_management_access',
            ],
            [
                'id'    => 44,
                'title' => 'address_create',
            ],
            [
                'id'    => 45,
                'title' => 'address_edit',
            ],
            [
                'id'    => 46,
                'title' => 'address_show',
            ],
            [
                'id'    => 47,
                'title' => 'address_delete',
            ],
            [
                'id'    => 48,
                'title' => 'address_access',
            ],
            [
                'id'    => 49,
                'title' => 'servier_management_access',
            ],
            [
                'id'    => 50,
                'title' => 'servicer_create',
            ],
            [
                'id'    => 51,
                'title' => 'servicer_edit',
            ],
            [
                'id'    => 52,
                'title' => 'servicer_show',
            ],
            [
                'id'    => 53,
                'title' => 'servicer_delete',
            ],
            [
                'id'    => 54,
                'title' => 'servicer_access',
            ],
            [
                'id'    => 55,
                'title' => 'oder_management_access',
            ],
            [
                'id'    => 56,
                'title' => 'order_create',
            ],
            [
                'id'    => 57,
                'title' => 'order_edit',
            ],
            [
                'id'    => 58,
                'title' => 'order_show',
            ],
            [
                'id'    => 59,
                'title' => 'order_delete',
            ],
            [
                'id'    => 60,
                'title' => 'order_access',
            ],
            [
                'id'    => 61,
                'title' => 'e_billing_management_access',
            ],
            [
                'id'    => 62,
                'title' => 'ebilling_create',
            ],
            [
                'id'    => 63,
                'title' => 'ebilling_edit',
            ],
            [
                'id'    => 64,
                'title' => 'ebilling_show',
            ],
            [
                'id'    => 65,
                'title' => 'ebilling_delete',
            ],
            [
                'id'    => 66,
                'title' => 'ebilling_access',
            ],
            [
                'id'    => 67,
                'title' => 'payment_method_create',
            ],
            [
                'id'    => 68,
                'title' => 'payment_method_edit',
            ],
            [
                'id'    => 69,
                'title' => 'payment_method_show',
            ],
            [
                'id'    => 70,
                'title' => 'payment_method_delete',
            ],
            [
                'id'    => 71,
                'title' => 'payment_method_access',
            ],
            // [
            //     'id'    => 72,
            //     'title' => 'qr_code_management_access',
            // ],
            // [
            //     'id'    => 73,
            //     'title' => 'qr_code_create',
            // ],
            // [
            //     'id'    => 74,
            //     'title' => 'qr_code_edit',
            // ],
            // [
            //     'id'    => 75,
            //     'title' => 'qr_code_show',
            // ],
            // [
            //     'id'    => 76,
            //     'title' => 'qr_code_delete',
            // ],
            // [
            //     'id'    => 77,
            //     'title' => 'qr_code_access',
            // ],
            [
                'id'    => 78,
                'title' => 'profile_password_edit',
            ],
            [
                'id'    => 79,
                'title' => 'merchant_approve',
            ],
            [
                'id'    => 80,
                'title' => 'merchant_reject',
            ],
            [
                'id'    => 81,
                'title' => 'card_management_access',
            ],
            [
                'id'    => 82,
                'title' => 'card_create',
            ],
            [
                'id'    => 83,
                'title' => 'card_edit',
            ],
            [
                'id'    => 84,
                'title' => 'card_show',
            ],
            [
                'id'    => 85,
                'title' => 'card_delete',
            ],
            [
                'id'    => 86,
                'title' => 'card_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
