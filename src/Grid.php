<?php

declare(strict_types=1);

namespace Zjbarg\Kata\MarsRover;

final readonly class Grid
{
    /**
     * @var list<Point>
     */
    public array $obstacles;

    public function __construct(
        public int $width = 10,
        public int $height = 10,
        Point ...$obstacles,
    ) {
        $this->obstacles = \array_values($obstacles);
    }

    public static function square(int $side, Point ...$obstacles): static
    {
        return new static($side, $side, ...$obstacles);
    }

    public function withObstacles(Point ...$obstacles): static
    {
        return new static($this->width, $this->height, ...$this->obstacles, ...$obstacles);
    }

    public function hasObstacleAt(Point $position): bool
    {
        return \array_any(
            $this->obstacles,
            fn (Point $obstacle) => $obstacle == $position,
        );
    }
}
