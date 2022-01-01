<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin'], function () {
    // Users
    Route::post('users/userUpdateAddress/{address}', 'UsersApiController@userUpdateAddress');
    Route::post('users/userAddAddress/{user}', 'UsersApiController@userAddAddress');
    Route::post('users/userUpdate/{user}', 'UsersApiController@userUpdate');
    Route::post('users/checkUser', 'UsersApiController@checkUser');
    Route::post('users/register', 'UsersApiController@register');
    Route::post('users/login', 'UsersApiController@login');
    Route::apiResource('users', 'UsersApiController');

    // Category
    Route::apiResource('categories', 'CategoryApiController');

    // Package
    Route::get('packages/packageFilter/{merchant}', 'PackageApiController@packageFilter');
    Route::apiResource('packages', 'PackageApiController');

    // Merchant
    Route::get('merchants/merchantWithCategory/{id}', 'MerchantApiController@merchantWithCategory');
    Route::get('merchants/randomShow', 'MerchantApiController@randomShow');
    Route::post('merchants/media', 'MerchantApiController@storeMedia')->name('merchants.storeMedia');
    Route::apiResource('merchants', 'MerchantApiController');

    // Country
    Route::apiResource('countries', 'CountryApiController');

    // State
    Route::get('states/chooseArea/{postcode}', 'StateApiController@chooseArea');
    Route::apiResource('states', 'StateApiController');

    // Address
    Route::apiResource('addresses', 'AddressApiController');

    // Servicer
    Route::apiResource('servicers', 'ServicerApiController');

    // Order
    Route::get('orders/orderFilterByUser/{userId}', 'OrderApiController@orderFilterByUser');
    Route::get('orders/orderWithComment/{merchant}', 'OrderApiController@orderWithComment');
    Route::post('orders/commentAndRate/{order}', 'OrderApiController@commentAndRate');
    Route::post('orders/updateOrder/{order}', 'OrderApiController@updateOrder');
    Route::get('orders/oldOrder/{id}', 'OrderApiController@oldOrder');
    Route::get('orders/newOrder/{id}', 'OrderApiController@newOrder');
    Route::apiResource('orders', 'OrderApiController');

    // Card
    Route::apiResource('cards', 'CardApiController');

    // Ebilling
    Route::post('ebillings/media', 'EbillingApiController@storeMedia')->name('ebillings.storeMedia');
    Route::apiResource('ebillings', 'EbillingApiController');

    // Payment Method
    Route::apiResource('payment-methods', 'PaymentMethodApiController');

    // Qr Code
    Route::apiResource('qr-codes', 'QrCodeApiController');
});
