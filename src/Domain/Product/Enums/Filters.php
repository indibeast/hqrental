<?php

namespace Domain\Product\Enums;

use Domain\Product\Filters\CategoryFilter;
use Domain\Product\Filters\Filter;
use Domain\Product\Filters\PriceFilter;

enum Filters: string
{
    case Category = 'category';
    case Price = 'price';

    public function createFilter(string $param): Filter
    {
        return match ($this) {
            self::Category => new CategoryFilter($param),
            self::Price => new PriceFilter($param),
        };
    }
}
