<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukCrudController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdukController;

Route::get('/', function () {
    return view('welcome'); // Ganti dengan view yang sesuai
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('auth.formlogin');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/register', [AuthController::class, 'registerForm'])->name('auth.formregister');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::middleware('role:2')->prefix('admin')->group(function () {
        Route::prefix('produks')->group(function () {
            Route::get('/', [ProdukCrudController::class, 'index'])->name('admin.produk.index');
            Route::get('/create', [ProdukCrudController::class, 'create'])->name('admin.produk.create');
            Route::post('/', [ProdukCrudController::class, 'store'])->name('admin.produk.store');
            Route::get('/{id}/edit', [ProdukCrudController::class, 'edit'])->name('admin.produk.edit');
            Route::put('/{id}', [ProdukCrudController::class, 'update'])->name('admin.produk.update');
            Route::delete('/{id}', [ProdukCrudController::class, 'destroy'])->name('admin.produk.destroy');
        });
    });

    Route::middleware('role:1')->prefix('home')->group(function () {
        Route::get('/', [ProdukController::class, 'index'])->name('home.index');
        Route::get('/produks/{id}', [ProdukController::class, 'show'])->name('home.show');
        Route::post('/produk/{id}/beli', [ProdukController::class, 'beli'])->name('produk.beli')->middleware('auth');
    });
});
