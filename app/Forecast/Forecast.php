<?php

namespace App\Forecast;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Forecast implements ForecastInterface
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getByCity($city)
    {
        if (empty($city)) {
            return ['error' => 404, 'message' => 'City not found'];
        }

        try {
            $url = $this->getRequestUrl($city);
            $response = $this->client->request('GET', $url);
            $forecastData = json_decode($response->getBody());
            $weatherCondition = $forecastData->forecastTimestamps[0]->conditionCode;
            $currentWeather = $weatherCondition == 'na' ? 'unknown' : $weatherCondition;

            return [
                'city' => ucfirst($city),
                'current_weather' => $currentWeather
            ];
        } catch (ClientException $exception) {
            return ['error' => 404, 'message' => 'City not found'];
        }
    }

    private function getRequestUrl($city)
    {
        return 'https://api.meteo.lt/v1/places/' . $city . '/forecasts/long-term';
    }
}
