<?php

namespace App\Forecast;

interface ForecastInterface
{
    public function getByCity($city);
}
