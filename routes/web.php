<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerProductController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\CheckTimeAccess;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('layout.admin');
});

// ============== ADMIN ROUTES ==============
Route::prefix('admin')->group(function () {

    Route::prefix('product')
        ->group(function () {
            Route::controller(ProductController::class)->group(function () {
                Route::get('/', 'index')->name('product');
                Route::get('/add', 'create')->name('create_product');
                Route::get('/detail/{id?}', 'getDetail')->name('detail_product');
                Route::get('/edit/{id?}', 'edit')->name('edit_product');
                Route::post('/store', 'store')->name('store_product');
                Route::put('/update/{id?}', 'update')->name('update_product');
                Route::get('/delete/{id?}', 'destroy')->name('delete_product');
                Route::put('/active/{id?}', 'active')->name('active_product');
            });
        });

    Route::prefix('category')
        ->group(function () {
            Route::controller(CategoryController::class)->group(function () {
                Route::get('/', 'index')->name('category');
                Route::get('/add', 'create')->name('create_category');
                Route::get('/detail/{id?}', 'getDetail')->name('detail_category');
                Route::get('/edit/{id?}', 'edit')->name('edit_category');
                Route::post('/store', 'store')->name('store_category');
                Route::put('/update/{id?}', 'update')->name('update_category');
                Route::get('/delete/{id?}', 'destroy')->name('delete_category');
                Route::put('/active/{id?}', 'active')->name('active_category');
            });
        });
});

// ============== CUSTOMER ROUTES ==============
Route::get('/product', [CustomerProductController::class, 'index'])->name('customer.product');

Route::resource('test', TestController::class);
Route::fallback(function () {
    return view('error.404');
})->name('404');


Route::get('/sinhvien/{name?}/{mssv?}', function (?string $name = "Luong Xuan Hieu", ?string $mssv = "123456") {
    return "Ho va ten: " . $name . "-MSSV: " . $mssv;
});
Route::get('/banco/{n?}', function (?int $n = 8) {
    return view('banco', ['n' => $n]);
});



// Xay du an

Route::prefix('')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('signIn', 'signIn')->name('signIn');
        Route::post('checkSignIn', 'checkSignIn')->name('checkSignIn');
        Route::get('login', 'showLoginForm')->name('login');
        Route::post('checkLogin', 'checkLogin')->name('checkLogin');
        Route::get('logout', 'logout')->name('logout');

    });
});

Route::get('/admin', function () {
    return view('layout.admin');
})->name('admin');
