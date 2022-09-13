<?php

namespace Domain\Product\ValueObjects;

class Percent
{
    public readonly float $value;

    public readonly string $formatted;

    public function __construct(float $value)
    {
        $this->value = $value;
        $this->formatted = number_format($this->value * 100).'%';
    }
}
