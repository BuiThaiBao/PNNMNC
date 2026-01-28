<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\CheckTimeAccess;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
})->middleware('checkAge');
// Route::get('/product', function () {
//     return view('product.index');
// });
// Route::get('/product/add', function () {
//     return view('product.add');
// })->name('product.add');
// Route::get('/product/detail/{id}', function ($id) {
//     return view('product.detail', ['id' => $id]);
// })->name('product.detail');



Route::prefix('product')
    // ->middleware('checkTimeAccess')
    ->middleware('checkAge')
    ->group(function () {
        Route::controller(ProductController::class)->group(function () {
            Route::get('/', 'index')->name('product');
            Route::get('/add', 'add')->name('add');
            Route::get('/detail/{id?}', 'getDetail')->name('detail');
            Route::post('/store', 'store');
        });
        // Route::get('/', [ProductController::class, 'index'])->name('product');
    
        // Route::get('/add', [ProductController::class, 'add'])->name('add');
    
        // Route::get('/detail/{id?}', [ProductController::class, 'getDetail'])->name('detail');
    });
Route::prefix('auth')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/checkLogin', 'checkLogin')->name('checkLogin');
        Route::get('/inputAge', 'inputAge')->name('inputAge');
        Route::post('/checkAge', 'checkAge')->name('checkAge');
    });
    Route::controller(AuthController::class)->group(function () {
        Route::get('/signIn', 'signIn')->name('signIn');
        Route::post('/checkSignIn', 'checkSignIn')->name('checkSignIn');
    });
});
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
