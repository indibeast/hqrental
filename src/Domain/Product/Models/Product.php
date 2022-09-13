<?php

namespace Domain\Product\Models;

use Database\Factories\Product\ProductFactory;
use Domain\Product\Builders\ProductBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function newEloquentBuilder($query): ProductBuilder
    {
        return new ProductBuilder($query);
    }

    protected static function newFactory()
    {
        return ProductFactory::new();
    }
}
