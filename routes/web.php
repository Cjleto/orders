<?php

use App\Models\User;
use App\Livewire\OrderIndex;
use App\Livewire\OrderCreate;
use App\Livewire\ProductShow;
use App\Livewire\ProductIndex;
use App\Livewire\ProductCreate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\RolesController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\CustomerController;
use App\Livewire\OrderShow;

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
        Route::resource('roles', RolesController::class)->except(['show','destroy']);
    });

    Route::middleware('can:manage_users')->group(function () {
        Route::resource('users', UserController::class)->except(['show']);
    });

});


Route::middleware('auth')->group(function () {

    // Approccio con blade
    Route::resource('customers', CustomerController::class);


    // Approccio con livewire
    Route::get('products', ProductIndex::class)->name('products.index');
    Route::get('products/show/{product}', ProductShow::class)->name('products.show');
    Route::get('products/create', ProductCreate::class)->name('products.create');

    Route::get('orders', OrderIndex::class)->name('orders.index');
    Route::get('orders/show/{order}', OrderShow::class)->name('orders.show');
    Route::get('orders/create', OrderCreate::class)->name('orders.create');

});
