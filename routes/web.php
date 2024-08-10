<?php

use App\Http\Controllers\Redirect\RedirectController;
use Illuminate\Support\Facades\Route;


Route::get('/redirect',[RedirectController::class, 'dashboard']);



Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
