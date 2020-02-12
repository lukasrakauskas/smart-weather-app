<?php

namespace Tests\Unit\ProductRepositor;

use App\Product\ProductRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductRepositoryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testIfRepoGivesCorrectProducts()
    {
        $originalProducts = factory(\App\Product::class, 10)->create(['name' => 'Boots'])->makeHidden(['created_at', 'updated_at'])->toArray();

        $productsFromRepo = (new ProductRepository())->getProductsByKeywords(['Boots'])->toArray();

        $this->assertEquals($originalProducts, $productsFromRepo);
    }
}
