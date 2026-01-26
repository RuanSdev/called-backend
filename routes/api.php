<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\UserController;
use App\Http\Middleware\PermissionMiddleware;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Middleware\JwtMiddleware;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Admin\UserRoleController;



Route::get('/status', function () {
    return response()->json(['status' => 'OK']);
})->name('status');



Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware(JwtMiddleware::class)->group(function () {

    Route::prefix('users')->group(function () {
        Route::post('/', [UserController::class, 'store'])->name('createUser');
        Route::put('{user}', [UserController::class, 'update'])->name('updateUser');

        Route::get('/', [UserController::class, 'index'])
            ->middleware(PermissionMiddleware::class . ':List-users')
            ->name('listUsers');

        Route::get('{user}', [UserController::class, 'show'])
            ->middleware(PermissionMiddleware::class . ':Get-user')
            ->name('GetUser');
        Route::delete('{user}', [UserController::class, 'destroy'])->name('deleteUser');
    });

    Route::prefix('companies')->group(function () {
        Route::post('/', [CompanyController::class, 'store'])->name('createCompany');
        Route::get('/', [CompanyController::class, 'index'])->name('listCompanies');

    });

    Route::prefix('admin')->group(function () {
        Route::middleware(RoleMiddleware::class)->group(function () {
            Route::post('/roles', [RoleController::class, 'store'])->name('createRole');
            Route::get('/roles/{id}', [RoleController::class, 'show'])->name('showRole');
            Route::get('/roles', [RoleController::class, 'index'])->name('listRoles');
            Route::post('/permissions', [PermissionController::class, 'store'])->name('createPermissions');
            Route::get('/permissions', [PermissionController::class, 'index'])->name('listPermissions');
            Route::post('/assign-role', [UserRoleController::class, 'assignRoleToUser'])->name('assignRoleToUser');

        });
    });

    Route::get('/logout', [LogoutController::class, 'logout'])->name('Logout');
});
