<?php

declare(strict_types=1);

namespace Zjbarg\Kata\MarsRover;

enum Orientation: int
{
    case North = 0;
    case East = 1;
    case South = 2;
    case West = 3;

    public function right(): static
    {
        return static::from(($this->value + 1) % 4);
    }

    public function left(): static
    {
        return static::from(($this->value - 1) % 4);
    }

    public function toString(): string
    {
        return match ($this) {
            static::North => 'N',
            static::East => 'E',
            static::South => 'S',
            static::West => 'W',
        };
    }
}
