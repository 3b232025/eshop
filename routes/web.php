<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\OrderController;

/*Route::resource('products', ProductController::class) ->only([
    'index', 'store', 'show', 'update', 'destroy'
]);

/*
【為何只保留這 5 條路由？】

1) index（GET /products）
   - 顯示商品列表頁

2) show（GET /products/{product}）
   - 顯示單一商品詳細資料

3) store（POST /products）
   - 新增商品資料（不另外設計 create 表單頁）

4) update（PUT/PATCH /products/{product}）
   - 更新商品資料

5) destroy（DELETE /products/{product}）
   - 刪除商品資料

【與 blog/admin 專案的差異】
- blog/admin 專案屬於後台管理系統，需要 create / edit 頁面來操作表單
- eshop 作業重點在 CRUD 邏輯與 API 行為，因此不需要 create、edit 表單頁
- 所以本專案使用 Route::resource 搭配 only()，限制只產生必要的 5 條路由
*/


// 以下為 Route::resource('products', ProductController::class)
// 預設產生的七個路由（等價寫法）

Route::get('/products', [ProductController::class, 'index']);        // 顯示商品列表
Route::get('/products/create', [ProductController::class, 'create']); // 顯示新增商品表單
Route::post('/products', [ProductController::class, 'store']);       // 新增商品
Route::get('/products/{product}', [ProductController::class, 'show']); // 顯示單一商品
Route::get('/products/{product}/edit', [ProductController::class, 'edit']); // 編輯商品表單
Route::put('/products/{product}', [ProductController::class, 'update']); // 更新商品
Route::delete('/products/{product}', [ProductController::class, 'destroy']); // 刪除商品


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
