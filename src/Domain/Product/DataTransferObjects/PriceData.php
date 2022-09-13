<?php

namespace Domain\Product\DataTransferObjects;

use Spatie\LaravelData\Data;

class PriceData extends Data
{
    public function __construct(
        public int $original,
        public int $final,
        public ?string $discount_percentage,
        public string $currency = 'EUR'
    ) {
    }
}
