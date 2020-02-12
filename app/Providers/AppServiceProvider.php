<?php

namespace App\Providers;

use App\Forecast\ForecastInterface;
use App\Forecast\Forecast;
use App\Product\ProductRepository;
use App\Product\ProductRepositoryInterface;
use App\Recommendation\Recommendation;
use App\Recommendation\RecommendationInterface;
use GuzzleHttp\Client;
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
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(ForecastInterface::class, Forecast::class);
        $this->app->bind(RecommendationInterface::class, Recommendation::class);

        $this->app->singleton('GuzzleHttp\Client', function () {
            return new Client();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
