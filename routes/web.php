<?php

use App\Http\Controllers\Frontend\LoginController;
use App\Http\Controllers\Frontend\VocController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Include the admin routes using the group method
require base_path('routes/admin.php');

Route::fallback(function () {
    return view('frontend.error');
});

Route::get('/', function () {
    return view('frontend.login');
});
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login/store', [LoginController::class, 'login'])->name('loginstore');

Route::group(['middleware' => ['auth']], function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('voc', [VocController::class, 'voc'])->name('voc');
    Route::post('customer-add', [VocController::class, 'customerCreate'])->name('customercreate');
    Route::get('/get-customer-details', [VocController::class, 'getCustomerDetails'])->name('getcustomerdetails');
    Route::post('/update-customer-details/{id}', [VocController::class, 'customerDetailsUpdate'])->name('customersdetailsupdate');
    Route::post('/feedback/{id}', [VocController::class, 'getPurchasedFeedback'])->name('getpurchasedfeedback');
    Route::get('/get-passed-history/{id}', [VocController::class, 'getPassedHistory'])->name('getpassedhistory');
});
