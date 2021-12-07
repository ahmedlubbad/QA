<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

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
    public function boot()
    {
        Validator::extend('filter', function ($attribute, $value) {
            $black = ['god', 'allah', 'sex'];
            foreach ($black as $word) {
                if (stripos($value, $word) !== false) {
                    return fasle;
                }
            }
            return true;
        }, 'this word is not allowed');

        Paginator::useBootstrap();
    }
}