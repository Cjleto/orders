<?php

namespace App\Providers;

use App;
use App\Repositories\Contracts\CustomerRepositoryContract;
use App\Repositories\Contracts\OrderRepositoryContract;
use App\Repositories\Contracts\ProductRepositoryContract;
use App\Repositories\Contracts\RoleRepositoryContract;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Repositories\Eloquent\CustomerRepository;
use App\Repositories\Eloquent\OrderRepository;
use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\Eloquent\RoleRepository;
use App\Repositories\Eloquent\UserRepository;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

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
        $this->app->bind(CustomerRepositoryContract::class, CustomerRepository::class);

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

            if ($isProduction) {

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
