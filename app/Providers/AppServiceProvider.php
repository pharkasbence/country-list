<?php

namespace App\Providers;

use App\Services\Contracts\CountryApiClient;
use App\Services\HttpClient\HttpClient;
use App\Services\RestCountryApiClient\RestCountryApiClient;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(RestCountryApiClient::class, function (Application $app) {
            return new RestCountryApiClient($app->make(HttpClient::class), config('countries.restcountries'));
        });

        $this->app->bind(CountryApiClient::class, RestCountryApiClient::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
