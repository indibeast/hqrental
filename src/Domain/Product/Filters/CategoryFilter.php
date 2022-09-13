<?php

namespace Domain\Product\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class CategoryFilter extends Filter
{
    public function handle(Builder $products, Closure $next): Builder
    {
        $products->where('category', $this->param);

        return $next($products);
    }
}
