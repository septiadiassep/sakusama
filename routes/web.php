<?php

use App\Http\Controllers\FinanceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard.index');
})->name('home');

Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::post('/users/store', [UserController::class, 'store'])->name('user.store');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');

Route::get('/finance', [FinanceController::class, 'index'])->name('finance.index');
Route::post('/finance/store', [FinanceController::class, 'store'])->name('finance.store');
Route::get('/finance/{id}/edit', [FinanceController::class, 'edit'])->name('finance.edit');
Route::delete('/finance/{id}', [FinanceController::class, 'destroy'])->name('finance.destroy');
Route::put('/finance/{id}', [FinanceController::class, 'update'])->name('finance.update');