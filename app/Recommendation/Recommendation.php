<?php

namespace App\Recommendation;

use Illuminate\Support\Str;
use App\Product;
use App\Product\ProductRepositoryInterface;

class Recommendation
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository) {
        $this->productRepository = $productRepository;
    }

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

        $products = $this->productRepository->getProductsByKeywords($keywords);

        return ['recommended_products' => $products];
    }
}
