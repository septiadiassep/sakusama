<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard.index');
})->name('home');

Route::get('/users', [UserController::class, 'index'])->name('user.index');
