<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'loginForm'])->name('auth.formlogin')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login')->middleware('guest');
Route::get('/register', [AuthController::class, 'registerForm'])->name('auth.formregister')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware('guest');

Route::group(['prefix' => 'admin', 'middleware' => 'auth:2'], function () {
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::get('/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
    Route::group(['prefix' => 'produks'], function () {
        Route::get('/', [ProdukController::class, 'index'])->name('produks.index');
        Route::get('/create', [ProdukController::class, 'create'])->name('produks.create');
        Route::post('/', [ProdukController::class, 'store'])->name('produks.store');
        Route::get('/{produk}', [ProdukController::class, 'show'])->name('produks.show');
        Route::get('/{produk}/edit', [ProdukController::class, 'edit'])->name('produks.edit');
        Route::put('/{produk}', [ProdukController::class, 'update'])->name('produks.update');
        Route::delete('/{produk}', [ProdukController::class, 'destroy'])->name('produks.destroy');
    });
});
