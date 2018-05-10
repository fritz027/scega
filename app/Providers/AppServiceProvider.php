<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use App\Http\Controllers\Validator\HashValidator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Validator::resolver(function($translator, $data, $rules, $message){
            return new HashValidator($translator, $data, $rules, $message);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
