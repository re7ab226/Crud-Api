<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('varchar', function ($attribute, $value, $parameters, $validator) {
            // Your validation logic for 'varchar' rule
            return is_string($value);
        });

        Validator::extend('enum', function ($attribute, $value, $parameters, $validator) {
            // Your validation logic for 'enum' rule
            $allowedValues = ['value1', 'value2', 'value3']; // Replace with your allowed values
            return in_array($value, $allowedValues);
        });
    }
}
