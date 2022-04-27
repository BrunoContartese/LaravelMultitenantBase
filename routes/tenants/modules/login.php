<?php
use Illuminate\Support\Facades\Route;

Route::post('/login', [\App\Http\Controllers\Tenants\Auth\LoginController::class, 'login']);
