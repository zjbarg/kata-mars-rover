<?php

declare(strict_types=1);

namespace Zjbarg\Kata\MarsRover;

final readonly class State
{
    public function __construct(
        public Point $position,
        public Orientation $orientation,
    ) {
    }

    public static function initial(): static
    {
        return new static(Point::origin(), Orientation::North);
    }

    public function right(): static
    {
        return new static($this->position, $this->orientation->right());
    }

    public function left(): static
    {
        return new static($this->position, $this->orientation->left());
    }

    public function forward(): static
    {
        return new static(
            $this->position->forward($this->orientation),
            $this->orientation,
        );
    }

    public function wrap(int $x, int $y): static
    {
        return new static(
            $this->position->wrap($x, $y),
            $this->orientation,
        );
    }

    public function toString(): string
    {
        return sprintf(
            '%s:%s',
            $this->position->toString(),
            $this->orientation->toString(),
        );
    }
}
