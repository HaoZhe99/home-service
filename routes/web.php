<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Route::view('merchant_register_index', 'auth.register');
Route::post('merchant_register', 'Admin\UsersController@merchant_register');

Auth::routes(['register' => true]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Category
    Route::delete('categories/destroy', 'CategoryController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'CategoryController');

    // Package
    Route::delete('packages/destroy', 'PackageController@massDestroy')->name('packages.massDestroy');
    Route::resource('packages', 'PackageController');

    // Merchant
    Route::get('merchants/approve/{merchant}', 'MerchantController@approve')->name('merchants.approve');
    Route::get('merchants/reject/{merchant}', 'MerchantController@reject')->name('merchants.reject');
    Route::delete('merchants/destroy', 'MerchantController@massDestroy')->name('merchants.massDestroy');
    Route::post('merchants/media', 'MerchantController@storeMedia')->name('merchants.storeMedia');
    Route::post('merchants/ckmedia', 'MerchantController@storeCKEditorImages')->name('merchants.storeCKEditorImages');
    Route::resource('merchants', 'MerchantController');

    // Country
    Route::delete('countries/destroy', 'CountryController@massDestroy')->name('countries.massDestroy');
    Route::resource('countries', 'CountryController');

    // State
    Route::delete('states/destroy', 'StateController@massDestroy')->name('states.massDestroy');
    Route::resource('states', 'StateController');

    // Address
    Route::delete('addresses/destroy', 'AddressController@massDestroy')->name('addresses.massDestroy');
    Route::resource('addresses', 'AddressController');

    // Servicer
    Route::delete('servicers/destroy', 'ServicerController@massDestroy')->name('servicers.massDestroy');
    Route::resource('servicers', 'ServicerController');

    // Order
    Route::post('orders/assign/{order}', 'OrderController@assign')->name('orders.assign');
    Route::get('orders/complete/{order}', 'OrderController@complete')->name('orders.complete');
    Route::get('orders/incomplete/{order}', 'OrderController@incomplete')->name('orders.incomplete');
    Route::delete('orders/destroy', 'OrderController@massDestroy')->name('orders.massDestroy');
    Route::resource('orders', 'OrderController');

    // Card
    Route::delete('cards/destroy', 'CardController@massDestroy')->name('cards.massDestroy');
    Route::resource('cards', 'CardController');

    // Ebilling
    Route::get('ebillings/approve/{ebilling}', 'EbillingController@approve')->name('ebillings.approve');
    Route::get('ebillings/reject/{ebilling}', 'EbillingController@reject')->name('ebillings.reject');
    Route::delete('ebillings/destroy', 'EbillingController@massDestroy')->name('ebillings.massDestroy');
    Route::post('ebillings/media', 'EbillingController@storeMedia')->name('ebillings.storeMedia');
    Route::post('ebillings/ckmedia', 'EbillingController@storeCKEditorImages')->name('ebillings.storeCKEditorImages');
    Route::resource('ebillings', 'EbillingController');

    // Payment Method
    Route::delete('payment-methods/destroy', 'PaymentMethodController@massDestroy')->name('payment-methods.massDestroy');
    Route::resource('payment-methods', 'PaymentMethodController');

    // Qr Code
    Route::delete('qr-codes/destroy', 'QrCodeController@massDestroy')->name('qr-codes.massDestroy');
    Route::resource('qr-codes', 'QrCodeController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
