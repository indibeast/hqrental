<?php

use Domain\Product\Models\Product;
use Illuminate\Testing\Fluent\AssertableJson;

test('it can lists products', function () {
    $this->withOutExceptionHandling();

    Product::factory()->create([
        'sku' => '000001',
        'name' => 'product 1',
        'category' => 'category',
        'price' => 1000,
    ]);

    $this->json('GET', 'api/products')->assertJson(fn (AssertableJson $json) => $json->has('products')
            ->has('products.0', fn ($json) => $json->where('sku', '000001')
                    ->where('name', 'product 1')
                    ->where('category', 'category')
                    ->where('price.original', 1000)
                    ->where('price.final', 1000)
                    ->where('price.discount_percentage', null)
                    ->where('price.currency', 'EUR')
            )
    );
});

test('insurance category should have a 30% discount', function () {
    Product::factory()->create([
        'sku' => '000001',
        'name' => 'product 1',
        'category' => 'insurance',
        'price' => 1000,
    ]);

    $this->json('GET', 'api/products')->assertJson(fn (AssertableJson $json) => $json->has('products')
        ->has('products.0', fn ($json) => $json->where('sku', '000001')
            ->where('name', 'product 1')
            ->where('category', 'insurance')
            ->where('price.original', 1000)
            ->where('price.final', 700)
            ->where('price.discount_percentage', '30%')
            ->where('price.currency', 'EUR')
        )
    );
});

test('product 000003 should have a 15% discount', function () {
    Product::factory()->create([
        'sku' => '000003',
        'name' => 'product 1',
        'category' => 'category',
        'price' => 1000,
    ]);

    $this->json('GET', 'api/products')->assertJson(fn (AssertableJson $json) => $json->has('products')
        ->has('products.0', fn ($json) => $json->where('sku', '000003')
            ->where('name', 'product 1')
            ->where('category', 'category')
            ->where('price.original', 1000)
            ->where('price.final', 850)
            ->where('price.discount_percentage', '15%')
            ->where('price.currency', 'EUR')
        )
    );
});

test('it should be filtered by category', function () {
    $productAInCategoryA = Product::factory()->create([
        'sku' => '000001',
        'name' => 'product A',
        'category' => 'categoryA',
        'price' => 1000,
    ]);

    $productBInCategoryB = Product::factory()->create([
        'sku' => '000002',
        'name' => 'product B',
        'category' => 'categoryB',
        'price' => 1000,
    ]);

    $this->json('GET', 'api/products?category=categoryB')->assertJson(fn (AssertableJson $json) => $json->has('products', 1)
        ->has('products.0', fn ($json) => $json->where('sku', '000002')
            ->where('name', 'product B')
            ->where('category', 'categoryB')
            ->where('price.original', 1000)
            ->where('price.final', 1000)
            ->where('price.discount_percentage', null)
            ->where('price.currency', 'EUR')
        )
    );
});

test('it should be filtered by price', function () {
    $productAInCategoryA = Product::factory()->create([
        'sku' => '000001',
        'name' => 'product A',
        'category' => 'categoryA',
        'price' => 2000,
    ]);

    $productBInCategoryB = Product::factory()->create([
        'sku' => '000002',
        'name' => 'product B',
        'category' => 'categoryB',
        'price' => 1000,
    ]);

    $productCInCategoryC = Product::factory()->create([
        'sku' => '000003',
        'name' => 'product C',
        'category' => 'categoryC',
        'price' => 3000,
    ]);

    $this->json('GET', 'api/products?price=1000')->assertJson(fn (AssertableJson $json) => $json->has('products', 1)
        ->has('products.0', fn ($json) => $json->where('sku', '000002')
            ->where('name', 'product B')
            ->where('category', 'categoryB')
            ->where('price.original', 1000)
            ->where('price.final', 1000)
            ->where('price.discount_percentage', null)
            ->where('price.currency', 'EUR')
        )
    );
});
