<?php

namespace Domain\Product\Actions;

use Domain\Product\Enums\Filters;
use Domain\Product\Models\Product;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Collection;

class FilterProductsAction
{
    public static function execute(array $filters): Collection
    {
        return app(Pipeline::class)
                ->send(Product::query())
            ->through(self::filters($filters))
            ->thenReturn()
            ->get();
    }

    private static function filters($filters)
    {
        return collect($filters)
            ->map(fn (string $param, string $key) => Filters::from($key)->createFilter($param))
            ->values()
            ->all();
    }
}
