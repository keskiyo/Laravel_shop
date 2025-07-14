<?php

use Illuminate\Support\Facades\{
    Route,
    Auth,
};
use App\Http\Controllers\{
    MainController,
    BasketController,
    DefaultPageController,
};
use App\Http\Controllers\Auth\{
    LoginController,
    VerificationController,
};
use App\Http\Controllers\Admin\{
    OrderController,
    CategoryController,
    ProductController,
    UserController,
};

// Авторизация и регистрация 
Auth::routes([
    'verify'=>true,
    'reset'=>false,
    'confirm'=>false,
]);


// Авторизация
Route::get('/logout', [LoginController::class, 'logout'])->name('get-logout');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::group([
        'prefix' => 'person',
        'as' => 'person.',
    ], function(){
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    });

    Route::group([
        'prefix' => 'admin',
    ], function () {
        Route::group([
            // 'middleware' => 'is_admin',
        ], function () {
            Route::get('/orders', [OrderController::class, 'index'])->name('home');
            Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

        });

        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::resource('users', UserController::class);
        
    });
});


// Основные (статические) страницы сайта 
Route::get('/', [DefaultPageController::class, 'main_page'])->name('main');
Route::get('/clients', [DefaultPageController::class, 'clients'])->name('clients');
Route::get('/kontakti', [DefaultPageController::class, 'kontakti'])->name('kontakti');
Route::get('/categories', [MainController::class, 'categories'])->name('categories');
Route::get('/tovars', [MainController::class, 'index'])->name('index');

// Route::get('/', [DefaultPageController::class, 'loading']);
Route::get('/categories/{category}/{product}', [MainController::class, 'product'])->name('product');
Route::get('/categories/{category}', [MainController::class, 'category'])->name('category');

Route::post('/subscription/{product}', [MainController::class, 'subscribe'])->name('subscription');

Route::post('/resend-verification', [VerificationController::class, 'resend'])->name('verification.resend'); 

// Корзина
Route::group(['prefix' => 'basket'], function () {
    Route::post('/add/{product}', [BasketController::class, 'basketAdd'])->name('basket-add');

    Route::group([
        // 'middleware' => 'basketNotEmpty',
    ], function () {
        Route::get('/', [BasketController::class, 'basket'])->name('basket');
        Route::post('/place', [BasketController::class, 'basketConfirm'])->name('basket-confirm');
        Route::post('/remove/{product}', [BasketController::class, 'basketRemove'])->name('basket-remove');
        Route::get('/place', [BasketController::class, 'basketPlace'])->name('basket-place');
    });
});



