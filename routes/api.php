<?php

use App\Http\Controllers\Api\CountryController;

use Illuminate\Support\Facades\Route;

Route::controller(CountryController::class)->group(function () {
    Route::group(['prefix' => 'countries'], function() {
        Route::get('/', 'index')->name('api.countries');
    });
});
