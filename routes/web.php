<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
// Route::get('/product', function () {
//     return view('product.index');
// });
// Route::get('/product/add', function () {
//     return view('product.add');
// })->name('product.add');
// Route::get('/product/detail/{id}', function ($id) {
//     return view('product.detail', ['id' => $id]);
// })->name('product.detail');

Route::prefix('product')->group(function () {
    Route::get('/', function () {
        return view('product.index');
    });
    Route::get('/add', function () {
        return view('product.add');
    })->name('add');
    Route::get('/{id?}', function (?string $id = "123") {
        return view('product.detail', ['id' => $id]);
    })->name('detail');
});

Route::fallback(function () {
    return view('error.404');
})->name('404');


Route::get('/sinhvien/{name?}/{mssv?}', function (?string $name = "Luong Xuan Hieu", ?string $mssv = "123456") {
    return "Ho va ten: " . $name . "-MSSV: " . $mssv;
});
Route::get('/banco/{n?}', function (?int $n = 8) {
    return view('banco', ['n' => $n]);
});
