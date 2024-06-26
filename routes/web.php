<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukCrudController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome'); // Ganti dengan view yang sesuai
});

Route::get('/blocked', function () {
    return view('blocked');
})->name('blocked');

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
        Route::post('/user/block/{id}', [UserController::class, 'block'])->name('user.block');
        Route::post('/user/unblock/{id}', [UserController::class, 'unblock'])->name('user.unblock');
        });
    });

    Route::middleware('role:1')->prefix('home')->group(function () {
        Route::get('/', [ProdukController::class, 'index'])->name('home.index');
        Route::get('/produks/{id}', [ProdukController::class, 'show'])->name('home.show');
        Route::post('/produk/{id}/beli', [ProdukController::class, 'beli'])->name('produk.beli')->middleware('auth');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/profile', [UserController::class, 'show'])->name('profile.show');
        Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
        Route::post('/profile', [UserController::class, 'update'])->name('profile.update');
        Route::post('/profile/delete', [UserController::class, 'destroy'])->name('profile.destroy');

        Route::post('/produk/{produk_id}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    });
});
