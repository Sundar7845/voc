<?php

use App\Http\Controllers\Backend\DashboardController;
use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    return view('frontend.error');
});

Route::group(['middleware' => ['auth']], function () {});

Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('live-user', [DashboardController::class, 'liveUser'])->name('liveuser');
Route::get('customer/{id}', [DashboardController::class, 'customerDetails'])->name('customer.details');
