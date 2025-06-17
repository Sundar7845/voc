<?php

use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\SaleController;
use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    return view('frontend.error');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('live-user', [HomeController::class, 'liveUser'])->name('liveuser');
    Route::get('customer/{id}', [HomeController::class, 'customerDetails'])->name('customer.details');
    Route::get('getrecord', [HomeController::class, 'getShowroomRecord'])->name('getrecord');
    Route::get('getliveuserrecord', [HomeController::class, 'liveUserShowroomRecord'])->name('getliveuserrecord');
    // Route::get('/customer/sales-report/{id}', [HomeController::class, 'getSalesReportData']);
    Route::get('getfeedback/{id}', [HomeController::class, 'getfeedback'])->name('getfeedback');
    Route::get('sales', [SaleController::class, 'sales'])->name('sales');
    Route::post('/import-sales', [SaleController::class, 'import'])->name('sales.import');
    Route::match(['get', 'post'], '/sales-report', [SaleController::class, 'getSalesReport'])->name('sales.getreport');
    Route::get('/downloadsheet', [SaleController::class, 'exampleSheet'])->name('downloadsheet');
    Route::get('showroom', [HomeController::class, 'showroom'])->name('showroom');
    Route::post('showroomdata', [HomeController::class, 'getShowroomData'])->name('getshowroomdata');
});
