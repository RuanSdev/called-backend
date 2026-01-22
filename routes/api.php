<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/status', function () {
    return response()->json(['status' => 'OK']);
});

Route::post('/users', [UserController::class, 'store']);
