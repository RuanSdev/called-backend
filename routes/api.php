<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Middleware\JwtMiddleware;


Route::get('/status', function () {
    return response()->json(['status' => 'OK']);
})->name('status');



Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware(JwtMiddleware::class)->group(function () {

    Route::prefix('users')->group(function () {
        Route::post('/', [UserController::class, 'store']);
        Route::put('{id}', [UserController::class, 'update']);
        Route::get('/', [UserController::class, 'index']);
    });

    Route::prefix('companies')->group(function () {
        Route::post('/', [CompanyController::class, 'store']);
        Route::get('/', [CompanyController::class, 'index']);

    });

    Route::prefix('admin')->group(function () {
        Route::post('/roles', [RoleController::class, 'store']);
        Route::get('/roles/{id}', [RoleController::class, 'show']);
    });
});
