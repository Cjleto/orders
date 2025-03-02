<?php

namespace App\Providers;

use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rules\Password;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\OrderRepository;
use App\Repositories\Eloquent\ProductRepository;
use RealRashid\SweetAlert\SweetAlertServiceProvider;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Repositories\Contracts\OrderRepositoryContract;
use App\Repositories\Contracts\ProductRepositoryContract;
use App\Repositories\Contracts\RoleRepositoryContract;
use App\Repositories\Eloquent\RoleRepository;
use Spatie\Permission\Contracts\Role;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Debugbar', \Barryvdh\Debugbar\Facades\Debugbar::class);

        if ($this->app->environment() == 'production') {
            Debugbar::enable();
        }

        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
        $this->app->bind(ProductRepositoryContract::class, ProductRepository::class);
        $this->app->bind(OrderRepositoryContract::class, OrderRepository::class);
        $this->app->bind(RoleRepositoryContract::class, RoleRepository::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $isProduction = App::environment('production');

        Paginator::useBootstrap();
        Model::shouldBeStrict();
        DB::prohibitDestructiveCommands($isProduction);

        Password::defaults(function () use ($isProduction) {
            $rule = Password::min(8);

            if($isProduction) {

                $rule->symbols()
                ->letters()
                ->numbers()
                ->mixedCase()
                ->uncompromised();
            }

            return $rule;
        });

    }
}
