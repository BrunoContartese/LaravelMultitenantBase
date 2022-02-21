<?php

Route::get('/users', function () {
    return \App\Models\User::all();
});
