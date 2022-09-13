<?php

namespace Domain\Product\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

abstract class Filter
{
    public function __construct(protected readonly string $param)
    {
    }

    abstract public function handle(Builder $products, Closure $next): Builder;
}
