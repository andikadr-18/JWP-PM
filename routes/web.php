<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerpustakaanController;

Route::resource('perpustakaan', PerpustakaanController::class);
Route::get('/', function () {
    return redirect()->route('welcome');
});

