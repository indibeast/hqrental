<?php

namespace Domain\Product\DataTransferObjects;

use Domain\Product\DataTransferObjects\Casts\PriceCast;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

class ProductData extends Data
{
    public function __construct(
        public string $sku,
        public string $name,
        public string $category,
        #[WithCast(PriceCast::class)]
        public PriceData $price,
    ) {
    }
}
