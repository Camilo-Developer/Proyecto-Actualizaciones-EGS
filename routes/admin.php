<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\Dashboard\DasboardController;
use App\Http\Controllers\Api\Admin\Logsuptproorgs\LogsuptproorgsController;
use App\Http\Controllers\Api\Admin\Organizations\OrganizationsController;
use App\Http\Controllers\Api\Admin\Products\ProductsController;
use App\Http\Controllers\Api\Admin\Proyects\ProyectsController;
use App\Http\Controllers\Api\Admin\Roles\RolesController;
use App\Http\Controllers\Api\Admin\States\StatesController;
use App\Http\Controllers\Api\Admin\Subscriptions\SubscriptionsController;
use App\Http\Controllers\Api\Admin\Uptproorganizations\UptproorganizationsController;
use App\Http\Controllers\Api\Admin\Users\UsersController;
use App\Http\Controllers\Api\Auth\ProfileController;

Route::get('/dashboard',[DasboardController::class,'index'])->middleware('can:admin.dashboard')->name('admin.dashboard');

Route::get('profile',[ProfileController::class, 'profile']);
Route::post('profile/update',[ProfileController::class, 'profileUpdate']);
Route::post('profile/password-update',[ProfileController::class, 'passwordUpdate']);


 Route::resource('states',StatesController::class);
 Route::resource('roles',RolesController::class);
 Route::resource('organizations',OrganizationsController::class);
 Route::resource('products',ProductsController::class);
 Route::resource('proyects',ProyectsController::class);
 Route::resource('subscriptions',SubscriptionsController::class);
 Route::resource('uptproorganizations',UptproorganizationsController::class);
 Route::resource('logsuptproorgs',LogsuptproorgsController::class);
 Route::resource('users',UsersController::class);

