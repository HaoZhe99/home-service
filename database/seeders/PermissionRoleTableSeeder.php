<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
        $user_permissions = $admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 11) != 'user_delete' && substr($permission->title, 0, 5) != 'role_' && substr($permission->title, 0, 11) != 'permission_' && substr($permission->title, 0, 16) != 'merchant_approve'
                && substr($permission->title, 0, 15) != 'merchant_reject' && substr($permission->title, 0, 9) != 'category_' && substr($permission->title, 0, 8) != 'country_'
                && substr($permission->title, 0, 6) != 'state_' && substr($permission->title, 0, 11) != 'user_create' && substr($permission->title, 0, 9) != 'e_billing'
                && substr($permission->title, 0, 8) != 'ebilling' && substr($permission->title, 0, 7) != 'payment' && substr($permission->title, 0, 3) != 'qr_'
                && substr($permission->title, 0, 8) != 'address_';
        });
        Role::findOrFail(2)->permissions()->sync($user_permissions);
    }
}
