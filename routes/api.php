<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CRUD\UserController;
use App\Http\Middleware\Permission;
use Illuminate\Support\Facades\Route;

Route::post('/Login', [AuthController::class, 'Login']);
Route::post('/Register', [AuthController::class, 'Register']);
Route::get('/Logout', [AuthController::class, 'logout']);
Route::middleware([Permission::class])->group(function () {
    Route::resources([
        '/User' => UserController::class,
    ]);
});