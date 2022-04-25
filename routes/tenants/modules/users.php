<?php
use Illuminate\Support\Facades\Route;

Route::get('/users', function () {
    return \App\Models\User::all();
});
