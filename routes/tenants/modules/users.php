<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/administration', 'middleware' => 'auth:sanctum'], function() {
    Route::apiResource('/users', \App\Http\Controllers\Tenants\Administration\UsersController::class);
    Route::post('/users/{user}/restore', [\App\Http\Controllers\Tenants\Administration\UsersController::class, 'restore']);
});

