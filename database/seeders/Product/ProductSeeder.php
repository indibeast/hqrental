<?php

namespace Database\Seeders\Product;

use Domain\Product\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = new Collection(json_decode(file_get_contents(base_path().'/database/seeders/Product/products.json'), true));

        $products->each(fn ($product) => Product::updateOrCreate(['sku' => $product['sku']], $product));
    }
}
