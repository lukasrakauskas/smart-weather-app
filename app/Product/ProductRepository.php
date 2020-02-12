<?php

namespace App\Product;

use App\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function getProductsByKeywords($keywords)
    {
        return Product::where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('name', 'like', '%' . $keyword . '%');
            }
        })->get()->makeHidden(['created_at', 'updated_at']);
    }
}
