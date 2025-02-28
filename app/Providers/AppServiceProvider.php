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
use RealRashid\SweetAlert\SweetAlertServiceProvider;


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
            // @TODO NON FUNZIONA
            Debugbar::enable();
        }

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Model::shouldBeStrict();
        DB::prohibitDestructiveCommands(App::environment('production'));

        Password::defaults(function () {
            $rule = Password::min(8);

            if($this->app->environment() == 'production') {

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
