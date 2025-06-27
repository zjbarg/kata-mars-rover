<?php

declare(strict_types=1);

namespace Zjbarg\Kata\MarsRover;

final readonly class Point
{
    public function __construct(
        public int $x,
        public int $y,
    ) {
    }

    public static function origin(): static
    {
        return new static(0, 0);
    }

    public function toString(): string
    {
        return \sprintf('%d:%d', $this->x, $this->y);
    }
}
