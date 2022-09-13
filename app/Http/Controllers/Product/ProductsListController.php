<?php

namespace App\Http\Controllers\Product;

use Domain\Product\Actions\FilterProductsAction;
use Domain\Product\DataTransferObjects\ProductData;

class ProductsListController
{
    public function __invoke()
    {
        $products = FilterProductsAction::execute(request()->only(['category', 'price']));

        return ProductData::collection($products)->wrap('products');
    }
}
