<?php

namespace Domain\Product\Actions;

use Domain\Product\Models\Product;

class CalculateDiscountAction
{
    public static function execute($productId)
    {
        $product = Product::find($productId);

        if ($product->sku === '000003') {
            return 0.15;
        }

        if ($product->category === 'insurance') {
            return 0.3;
        }

        return null;
    }
}
