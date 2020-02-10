<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use App\Product;
use Illuminate\Support\Str;
use App\Forecast\Forecast;
use App\Recommendation\Recommendation;

class RecommendedController extends Controller
{
    private $forecast;
    private $recommendation;

    public function __construct(Forecast $forecast, Recommendation $recommendation)
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
