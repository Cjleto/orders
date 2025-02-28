<?php

use App\Models\User;
use App\Livewire\DishIndex;
use App\Livewire\DishCreate;
use App\Livewire\PublicMenu;
use App\Livewire\CompanyEdit;
use App\Livewire\MapEntities;
use App\Livewire\CategoryEdit;
use App\Livewire\CategoryShow;
use App\Livewire\CompanySettings;
use App\Livewire\SubCategoryEdit;
use App\Livewire\TranslationIndex;
use App\Livewire\MacroCategoryEdit;
use App\Livewire\MacroCategoryShow;
use App\Livewire\TranslationsIndex;
use App\Livewire\MacroCategoryIndex;
use Illuminate\Support\Facades\Auth;
use App\Livewire\MacroCategoryCreate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\TranslationsController;
use App\Http\Middleware\CompanyExists;

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/', 'home', 301);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
Route::get('toggle-theme', [UserController::class, 'toggleTheme'])->name('toggle.theme');

Route::impersonate();


// ADMIN
Route::middleware(['auth', 'impersonate.protect'])->prefix('admin')->group(function () {

    Route::get('/home', [HomeController::class, 'index_admin'])->name('admin.home');

    Route::middleware('can:manage_roles')->group(function () {
        Route::resource('roles', RolesController::class);
    });

    Route::middleware('can:manage_users')->group(function () {
        Route::resource('users', UserController::class);
    });

    Route::middleware('can:manage_companies')->group(function () {
        Route::resource('companies', CompaniesController::class);
        Route::get('companies/{company}/edit', CompanyEdit::class)->name('companies.edit');
    });


});


/// MANAGERS
Route::middleware(['auth', CompanyExists::class, 'can:manage_macro_categories', 'registerVisit'])->group(function () {
    Route::get('home_managers', [HomeController::class, 'index_managers'])->name('home_managers');

    Route::get('missing_company', function () {
        return view('companies.missing');
    })
    ->withoutMiddleware(CompanyExists::class)
    ->name('missing_company');

    Route::get('macro_categories', MacroCategoryIndex::class)->name('macro_categories.index');
    Route::get('macro_categories/create', MacroCategoryCreate::class)->name('macro_categories.create');
    Route::get('macro_categories/{macro_category}', MacroCategoryShow::class)->name('macro_categories.show');
    Route::get('macro_categories/{macro_category}/edit', MacroCategoryEdit::class)->name('macro_categories.edit');
    Route::get('category/{category}', CategoryShow::class)->name('categories.show');
    Route::get('category/{category}/edit', CategoryEdit::class)->name('categories.edit');
    Route::get('sub_category/{sub_category}/edit', SubCategoryEdit::class)->name('sub_categories.edit');
    Route::get('category/{category}/dish/{search?}', DishIndex::class)->name('category.dishes.index');
    Route::get('sub_category/{sub_category}/dish', DishIndex::class)->name('sub_category.dishes.index');
    Route::get('dish/create/{user}/{selected_macro_id?}/{selected_category_id?}/{selected_sub_category_id?}', DishCreate::class)->name('dishes.create');


    Route::get('map-entities/{user}', MapEntities::class)
        ->middleware('existsOneVisibleDish')
        ->name('map-entities');
    Route::get('company-settings', CompanySettings::class)
        ->middleware('existsOneVisibleDish')
        ->name('company.settings');

    Route::get('translations/{model}/{model_id}', TranslationsIndex::class)->name('model.translations.index');
    Route::get('translations2/{model}/{model_id}', [TranslationsController::class, 'index'])->name('model.translations2.index');



});


Route::get('/missing_menu_setting', function () {
    return view('errors.settings.missing');
})->name('missing_menu_setting');


Route::get('/{company:slug}', PublicMenu::class)->name('public.menu')
    ->middleware([
        'setLocale',
        'missingMenuSetting',
        'registerVisit',
    ]);


