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
                && substr($permission->title, 0, 26) != 'merchant_management_access' && substr($permission->title, 0, 25) != 'servier_management_access' && substr($permission->title, 0, 8) != 'country_'
                && substr($permission->title, 0, 6) != 'state_' && substr($permission->title, 0, 11) != 'user_create' && substr($permission->title, 0, 15) != 'ebilling_create' && substr($permission->title, 0, 13) != 'ebilling_edit'
                && substr($permission->title, 0, 15) != 'ebilling_delete' && substr($permission->title, 0, 7) != 'payment' && substr($permission->title, 0, 12) != 'order_create'
                && substr($permission->title, 0, 10) != 'order_edit'  && substr($permission->title, 0, 12) != 'order_delete'
                && substr($permission->title, 0, 21) != 'payment_method_access';
        });
        Role::findOrFail(2)->permissions()->sync($user_permissions);

        $merchant_permissions = $admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 11) != 'user_delete' && substr($permission->title, 0, 5) != 'role_' && substr($permission->title, 0, 11) != 'permission_' && substr($permission->title, 0, 16) != 'merchant_approve'
                && substr($permission->title, 0, 8) != 'country_' && substr($permission->title, 0, 6) != 'state_' && substr($permission->title, 0, 15) != 'category_access' && substr($permission->title, 0, 7) != 'payment' 
                && substr($permission->title, 0, 21) != 'payment_method_access' && substr($permission->title, 0, 22) != 'card_management_access';
        });
        Role::findOrFail(3)->permissions()->sync($merchant_permissions);

        $servicer_permissions = $admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 11) != 'user_delete' && substr($permission->title, 0, 5) != 'role_' && substr($permission->title, 0, 11) != 'permission_' && substr($permission->title, 0, 16) != 'merchant_approve'
                && substr($permission->title, 0, 26) != 'merchant_management_access' && substr($permission->title, 0, 25) != 'servier_management_access' && substr($permission->title, 0, 8) != 'country_'
                && substr($permission->title, 0, 6) != 'state_' && substr($permission->title, 0, 11) != 'user_create' && substr($permission->title, 0, 27) != 'e_billing_management_access' 
                && substr($permission->title, 0, 7) != 'payment' && substr($permission->title, 0, 12) != 'order_create'
                && substr($permission->title, 0, 10) != 'order_edit'  && substr($permission->title, 0, 12) != 'order_delete' && substr($permission->title, 0, 22) != 'card_management_access'
                && substr($permission->title, 0, 21) != 'payment_method_access';
        });
        Role::findOrFail(4)->permissions()->sync($servicer_permissions);
    }
}
