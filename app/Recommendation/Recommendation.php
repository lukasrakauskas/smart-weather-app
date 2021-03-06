<?php

namespace App\Recommendation;

use Illuminate\Support\Str;
use App\Product\ProductRepositoryInterface;

class Recommendation implements RecommendationInterface
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    private $recommendations = [
        'sleet' => ['coat', 'wellington boots', 'sweater'],
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

        $keywords = [];

        foreach (array_keys($this->recommendations) as $key) {
            if (Str::contains($forecast['current_weather'], $key)) {
                $keywords = $this->recommendations[$key];
            }
        }

        $products = $this->productRepository->getProductsByKeywords($keywords);

        return ['recommended_products' => $products];
    }
}
