<?php

use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('login',[AuthController::class,'login']);
Route::post('register',[AuthController::class,'register']);


Route::group([
    'middleware' => ['auth:sanctum']
], function(){
    Route::post('logout',[AuthController::class, 'logout']);
});
