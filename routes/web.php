<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\RolesController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\CustomerController;

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/', 'home', 301);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
Route::get('toggle-theme', [UserController::class, 'toggleTheme'])->name('toggle.theme');



// ADMIN
Route::prefix('admin')->group(function () {

    Route::get('/home', [HomeController::class, 'index_admin'])->name('admin.home');

    Route::middleware('can:manage_roles')->group(function () {
        Route::resource('roles', RolesController::class);
    });

    Route::middleware('can:manage_users')->group(function () {
        Route::resource('users', UserController::class);
    });

});

// CUSTOMERS
Route::middleware('auth')->group(function () {

    Route::resource('customers', CustomerController::class);

});
