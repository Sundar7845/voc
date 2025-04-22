<?php

use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    return view('frontend.error');
});

Route::group(['middleware' => ['auth']], function () {});

