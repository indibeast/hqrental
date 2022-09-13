<?php

namespace Domain\Product\DataTransferObjects\Casts;

use Domain\Product\Actions\CalculateDiscountAction;
use Domain\Product\DataTransferObjects\PriceData;
use Domain\Product\ValueObjects\Percent;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\DataProperty;

class PriceCast implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $context): mixed
    {
        $discount = CalculateDiscountAction::execute($context['id']);

        return PriceData::from([
            'original' => $value,
            'final' => $discount ? round($value * (1 - $discount)) : $value,
            'discount_percentage' => $discount ? (new Percent($discount))->formatted : null,
        ]);
    }
}
