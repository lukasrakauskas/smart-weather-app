<?php

namespace App\Recommendation;

interface RecommendationInterface
{
    public function getProductsByForecast($forecast);
}
