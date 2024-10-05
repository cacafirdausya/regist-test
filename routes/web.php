<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FibonacciController;

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');
    Route::get('refresh/captcha', 'refreshCaptcha')->name('refresh.captcha');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});


Route::middleware('auth')->group(function () {
    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::get('/edit/{encrypted_id}', [UserController::class, 'edit'])->name('edit');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::post('/update/{encrypted_id}', [UserController::class, 'update'])->name('update');
        Route::post('/destroy', [UserController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'fibonacci', 'as' => 'fibonacci.'], function () {
        Route::get('/', [FibonacciController::class, 'index'])->name('index');
    });

    Route::get('dashboard', function () {
        return view('layouts/app');
    })->name('dashboard');


    Route::get('/profile', [App\Http\Controllers\AuthController::class, 'profile'])->name('profile');
});
