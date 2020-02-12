<?php

namespace App\Http\Controllers;

use App\Forecast\ForecastInterface;
use App\Recommendation\RecommendationInterface;

class RecommendedController extends Controller
{
    private $forecast;
    private $recommendation;

    public function __construct(ForecastInterface $forecast, RecommendationInterface $recommendation)
    {
        $this->forecast = $forecast;
        $this->recommendation = $recommendation;
    }

    public function index($city)
    {
        $forecast = $this->forecast->getByCity($city);

        if (array_key_exists('error', $forecast))
            return response()->json($forecast, 404);

        $products = $this->recommendation->getProductsByForecast($forecast);

        return response()->json(array_merge($forecast, $products));
    }
}
