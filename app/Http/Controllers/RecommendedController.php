<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use App\Product;
use Illuminate\Support\Str;

class RecommendedController extends Controller
{
    public function index($cityParam)
    {
        $city = ucfirst($cityParam);

        $client = new Client();
        try {
            $response = $client->request('GET', 'https://api.meteo.lt/v1/places/' . $city . '/forecasts/long-term');            
            $data = json_decode($response->getBody());
            $weatherCondition = $data->forecastTimestamps[0]->conditionCode;

            if ($weatherCondition == 'na') {
                return response()->json([
                    'city' => $city,
                    'current_weather' => 'Unknown'
                ]);
            }

            $recommendations = [
                'clear' => ['sunglasses'],
                'clouds' => ['sweater', 'coat'],
                'overcast' => ['sweater', 'coat'],
                'rain' => ['coat', 'wellington boots'],
                'snow' => ['coat'],
                'fog' => ['coat', 'sweater'],
            ];
                        
            foreach (array_keys($recommendations) as $key) {
                if (Str::contains($weatherCondition, $key)) {
                    $keywords = $recommendations[$key];
                }
            }

            $products = Product::where(function ($query) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $query->orWhere('name', 'like', '%' . $keyword . '%');
                }
            })->limit(3)->get()->makeHidden(['created_at', 'updated_at']);

            return response()->json([
                'city' => $city,
                'current_weather' => $weatherCondition,
                'recommended_products' => $products
            ]);
        } catch (ClientException $exception) {
            return response()->json([ 'error'=> 404, 'message'=> 'City not found' ], 404);
        }
    }
}
