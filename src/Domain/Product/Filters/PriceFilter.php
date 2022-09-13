<?php

namespace Domain\Product\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class PriceFilter extends Filter
{
    public function handle(Builder $products, Closure $next): Builder
    {
        $products->where('price', $this->param);

        return $next($products);
    }
}
