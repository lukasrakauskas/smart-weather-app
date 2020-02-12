<?php

namespace App\Product;

interface ProductRepositoryInterface
{
    public function getProductsByKeywords($keywords);
}