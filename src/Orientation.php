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
        return match ($this) {
            static::North => static::East,
            static::East => static::South,
            static::South => static::West,
            static::West => static::North,
        };
    }

    public function left(): static
    {
        return match ($this) {
            static::North => static::West,
            static::East => static::North,
            static::South => static::East,
            static::West => static::South,
        };
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
