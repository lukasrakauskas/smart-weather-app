<?php

namespace App\Recommendation;

use Illuminate\Support\Str;
use App\Product;

class Recommendation
{
    private $recommendations = [
        'clear' => ['sunglasses'],
        'clouds' => ['sweater', 'coat'],
        'overcast' => ['sweater', 'coat'],
        'rain' => ['coat', 'wellington boots'],
        'snow' => ['coat'],
        'fog' => ['coat', 'sweater'],
    ];

    public function getProductsByForecast($forecast)
    {
        if (empty($forecast))
            return [];

        foreach (array_keys($this->recommendations) as $key) {
            if (Str::contains($forecast['current_weather'], $key)) {
                $keywords = $this->recommendations[$key];
            }
        }

        $products = Product::where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('name', 'like', '%' . $keyword . '%');
            }
        })->limit(3)->get()->makeHidden(['created_at', 'updated_at']);

        return ['recommended_products' => $products];
    }
}
