# Smart Weather App

## Task

https://github.com/lukasrakauskas/smart-weather-app/blob/master/Back%20End%20task.pdf

## Challenge

Create a service, which returns product recommendations depending on current weather.

## Technologies

- PHP 7.3.8
- MariaDB 10.4.6
- Laravel Framework 6.14.0

## Setup guide

### Prerequisites

- Composer - https://getcomposer.org/
- Laravel - https://laravel.com/docs/6.x/installation
- PHP
- MySQL Server

### Setup

    git clone https://github.com/lukasrakauskas/smart-weather-app.git 
    cd smart-weather-app
    composer install
    # Create .env file
    php artisan migrate # To set up database
    php artisan db:seed # To generate fake data
    php artisan serve
    
## Usage examples

GET http://127.0.0.1:8000/api/products/recommended/kaunas

    {
        "city": "Kaunas",
        "current_weather": "light-rain",
        "recommended_products": [
            {
                "id": 6,
                "sku": "AC-490",
                "name": "Aqua Coat",
                "price": 2.88
            },
            {
                "id": 12,
                "sku": "OW-912",
                "name": "Olive Wellington boots",
                "price": 20.1
            },
            {
                "id": 14,
                "sku": "WC-980",
                "name": "White Coat",
                "price": 71.21
            }
        ]
    }

GET http://127.0.0.1:8000/api/products/recommended/kunas

    {
        "error": 404,
        "message": "City not found"
    }

## Live example

Hosted on Heroku

https://weather-product-app.herokuapp.com
