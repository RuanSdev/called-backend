<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Middleware\JwtMiddleware;
use App\Http\Controllers\Auth\LogoutController;


Route::get('/status', function () {
    return response()->json(['status' => 'OK']);
})->name('status');



Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware(JwtMiddleware::class)->group(function () {

    Route::prefix('users')->group(function () {
        Route::post('/', [UserController::class, 'store'])->name('createUser');
        Route::put('{id}', [UserController::class, 'update'])->name('updateUser');
        Route::get('/', [UserController::class, 'index'])->name('listUsers');
    });

    Route::prefix('companies')->group(function () {
        Route::post('/', [CompanyController::class, 'store'])->name('createCompany');
        Route::get('/', [CompanyController::class, 'index'])->name('listCompanies');

    });

    Route::prefix('admin')->group(function () {
        Route::post('/roles', [RoleController::class, 'store'])->name('createRole');
        Route::get('/roles/{id}', [RoleController::class, 'show'])->name('showRole');
        Route::post('/permissions', [PermissionController::class, 'store'])->name('createPermissions');
        Route::get('/permissions', [PermissionController::class, 'index'])->name('listPermissions');

    });

    Route::get('/logout', [LogoutController::class, 'logout'])->name('Logout');
});
