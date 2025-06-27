<?php

declare(strict_types=1);

namespace Zjbarg\Kata\MarsRover;

enum Orientation
{
    case North;
    case East;
    case South;
    case West;

    public function turnRight(): static
    {
        return match ($this) {
            static::North => static::East,
            static::East => static::South,
            static::South => static::West,
            static::West => static::North,
        };
    }

    public function turnLeft(): static
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
