<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerpustakaanController;

Route::get('/', function () {
    return redirect()->route('welcome');
    Route::resource('perpustakaan', PerpustakaanController::class);
});

