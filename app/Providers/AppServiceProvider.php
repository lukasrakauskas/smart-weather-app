<?php

namespace App\Providers;

use App\Forecast\ForecastInterface;
use App\Forecast\Forecast;
use App\Product\ProductRepository;
use App\Product\ProductRepositoryInterface;
use App\Recommendation\Recommendation;
use App\Recommendation\RecommendationInterface;
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
