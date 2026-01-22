<?php

use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Company\CompanyController;
use Illuminate\Routing\Controllers\Middleware;

Route::get('/status', function () {
    return response()->json(['status' => 'OK']);
})->name('status');



Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'users'], function () {
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
    });
    Route::group(['prefix' => 'companies'], function () {
        Route::post('/', [CompanyController::class, 'store'])->name('companies.store');
        Route::get('/', [CompanyController::class, 'index'])->name('companies.index');
    });
});
