<?php

use Illuminate\Support\Facades\Route;

Route::get('getFibonacci', [\App\Http\Controllers\API\FibonacciController::class, 'generate'])
        ->name('getFibonacci');

