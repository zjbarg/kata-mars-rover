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

    public function forward(Orientation $orientation): static
    {
        [$x, $y] = match ($orientation) {
            Orientation::North => [0, 1],
            Orientation::East => [1, 0],
            Orientation::South => [0, -1],
            Orientation::West => [-1, 0],
        };

        return new static(
            $this->x + $x,
            $this->y + $y,
        );
    }

    public function wrap(int $x, int $y): static
    {
        return new static(
            $this->x % $x,
            $this->y % $y,
        );
    }

    public function toString(): string
    {
        return \sprintf('%d:%d', $this->x, $this->y);
    }
}
