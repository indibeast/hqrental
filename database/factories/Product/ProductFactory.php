<?php

namespace Database\Factories\Product;

use Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'sku' => $this->faker->randomNumber(6),
            'name' => $this->faker->word,
            'category' => $this->faker->word,
            'price' => $this->faker->randomNumber(5),
        ];
    }
}
