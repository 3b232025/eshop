<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\OrderController;

Route::resource('products', ProductController::class) ->only([
    'index', 'store', 'show', 'update', 'destroy'
]);

/*
products.index
URI：/products
HTTP 動詞：GET
控制器與方法：ProductController@index

products.create
URI：/products/create
HTTP 動詞：GET
控制器與方法：ProductController@create

products.store
URI：/products
HTTP 動詞：POST
控制器與方法：ProductController@store

products.show
URI：/products/{product}
HTTP 動詞：GET
控制器與方法：ProductController@show

products.edit
URI：/products/{product}/edit
HTTP 動詞：GET
控制器與方法：ProductController@edit

products.update
URI：/products/{product}
HTTP 動詞：PUT / PATCH
控制器與方法：ProductController@update

products.destroy
URI：/products/{product}
HTTP 動詞：DELETE
控制器與方法：ProductController@destroy
*/

Route::middleware(['auth'])->group(function () {
    Route::resource('cart_items', CartItemController::class)->only(['index']);
});


Route::middleware(['auth'])->group(function () {
    Route::resource('orders', OrderController::class)->only(['index', 'show']);
});

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
