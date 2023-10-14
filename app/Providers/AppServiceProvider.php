<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(){

        Paginator::useBootstrap();

        Validator::extend('formato', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^[A-Z]{3}-\d-[A-Z]-\d{2}$/', $value);
        });
    }
}
