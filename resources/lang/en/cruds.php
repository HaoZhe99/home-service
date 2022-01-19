<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'username'                 => 'Username',
            'username_helper'          => ' ',
            'phone'                    => 'Phone',
            'phone_helper'             => ' ',
            'verify'                   => 'Verify',
            'verify_helper'            => ' ',
            'verify_token'             => 'Verify Token',
            'verify_token_helper'      => ' ',
            'address'                  => 'Address',
            'address_helper'           => ' ',
        ],
    ],
    'merchantManagement' => [
        'title'          => 'Merchant Management',
        'title_singular' => 'Merchant Management',
    ],
    'category' => [
        'title'          => 'Category',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'package' => [
        'title'          => 'Package',
        'title_singular' => 'Package',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'price'              => 'Price',
            'price_helper'       => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'merchant'           => 'Merchant',
            'merchant_helper'    => ' ',
            'status'             => 'Status',
            'status_helper'      => ' ',
        ],
    ],
    'merchant' => [
        'title'          => 'Merchant',
        'title_singular' => 'Merchant',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'name'           => 'Name',
            'name_helper'    => ' ',
            'description'           => 'Description',
            'description_helper'    => ' ',
            'contact_number'        => 'Contact Number',
            'contact_number_helper' => ' ',
            'address'               => 'Address',
            'address_helper'        => ' ',
            'delivery_fee'             => 'Delivery Fee',
            'delivery_fee_helper'      => ' ',
            'latitude'              => 'Latitude',
            'latitude_helper'       => ' ',
            'ssm_number'            => 'Ssm Number',
            'ssm_number_helper'     => ' ',
            'ssm_document'          => 'Ssm Document',
            'ssm_document_helper'   => ' ',
            'logo'                  => 'Logo',
            'logo_helper'           => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
            'postcode'                 => 'Postcode',
            'postcode_helper'          => ' ',
            'state'                 => 'State',
            'state_helper'          => ' ',
            'category'              => 'Category',
            'category_helper'       => ' ',
            'status'                => 'Status',
            'status_helper'         => ' ',
        ],
    ],
    'country' => [
        'title'          => 'Country',
        'title_singular' => 'Country',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'country'           => 'Country',
            'country_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'state' => [
        'title'          => 'State',
        'title_singular' => 'State',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'state'             => 'State',
            'state_helper'      => ' ',
            'postcode'          => 'Postcode',
            'postcode_helper'   => ' ',
            'area'          => 'Area',
            'area_helper'   => ' ',
            'country'           => 'Country',
            'country_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'addressManagement' => [
        'title'          => 'Address Management',
        'title_singular' => 'Address Management',
    ],
    'address' => [
        'title'          => 'Address',
        'title_singular' => 'Address',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'address'           => 'Address',
            'address_helper'    => ' ',
            'state'             => 'State',
            'state_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'servierManagement' => [
        'title'          => 'Servicer Management',
        'title_singular' => 'Servicer Management',
    ],
    'servicer' => [
        'title'          => 'Servicer',
        'title_singular' => 'Servicer',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'user'              => 'User',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'merchant'          => 'Merchant',
            'merchant_helper'   => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
        ],
    ],
    'oderManagement' => [
        'title'          => 'Oder Management',
        'title_singular' => 'Oder Management',
    ],
    'order' => [
        'title'          => 'Order',
        'title_singular' => 'Order',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'price'             => 'Price',
            'price_helper'      => ' ',
            'status'            => 'Status',
            'status_helper'     => ' ',
            'payment_method'    =>'Payment Method',
            'payment_method_helper'=>'',
            'comment'           => 'Comment',
            'comment_helper'    => ' ',
            'rate'              => 'Rate (Star)',
            'rate_helper'       => ' ',
            'date'              => 'Date',
            'date_helper'       => ' ',
            'time'              => 'Time',
            'time_helper'       => ' ',
            'remark'            => 'Remark',
            'remark_helper'     => ' ',
            'merchant'          => 'Merchant',
            'merchant_helper'   => ' ',
            'package'           => 'Package',
            'package_helper'    => ' ',
            'user'              => 'Customer',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'servicer'          => 'Servicer',
            'servicer_helper'   => ' ',
            'qr_code'           => 'Qr Code',
            'qr_code_helper'    => ' ',
        ],
    ],
    'cardManagement' => [
        'title'          => 'Card Management',
        'title_singular' => 'Card Management',
    ],
    'card' => [
        'title'          => 'Card',
        'title_singular' => 'Card',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'bank_of_card'      => 'Bank of Card',
            'bank_of_card_helper'      => ' ',
            'name_of_card'            => 'Name of Card',
            'name_of_card_helper'     => ' ',
            'card_number'    =>'Card Number',
            'card_number_helper'=>'',
            'expired_date'           => 'Expired Date',
            'expired_date_helper'    => ' ',
            'cvv'              => 'CVV',
            'cvv_helper'       => ' ',
            'user'              => 'User',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'eBillingManagement' => [
        'title'          => 'E Billing Management',
        'title_singular' => 'E Billing Management',
    ],
    'ebilling' => [
        'title'          => 'E-billing',
        'title_singular' => 'E-billing',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'money'                 => 'Money',
            'money_helper'          => ' ',
            'status'                => 'Status',
            'status_helper'         => ' ',
            'receipt'               => 'Receipt',
            'receipt_helper'        => ' ',
            'remark'                => 'Remark',
            'remark_helper'         => ' ',
            'order'                 => 'Order',
            'order_helper'          => ' ',
            'user'                  => 'Customer',
            'user_helper'           => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
            'payment_method'        => 'Payment Method',
            'payment_method_helper' => ' ',
        ],
    ],
    'paymentMethod' => [
        'title'          => 'Payment Method',
        'title_singular' => 'Payment Method',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'status'            => 'Status',
            'status_helper'     => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
        ],
    ],
    'qrCodeManagement' => [
        'title'          => 'Qr Code Management',
        'title_singular' => 'Qr Code Management',
    ],
    'qrCode' => [
        'title'          => 'Qr Code',
        'title_singular' => 'Qr Code',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'code'              => 'Code',
            'code_helper'       => ' ',
            'status'            => 'Status',
            'status_helper'     => ' ',
            'expired_at'         => 'Expired At',
            'expied_at_helper'  => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
];
