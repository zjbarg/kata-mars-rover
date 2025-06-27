<?php

declare(strict_types=1);

namespace Zjbarg\Kata\MarsRover;

final readonly class Grid
{
    /** @var list<Point> */
    private array $obstacles;

    public function __construct(
        public int $width,
        public int $height,
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

    public function getPositionNextTo(Point $position, Orientation $orientation): Point
    {
        if (!$this->has($position)) {
            throw new \Exception('Given position not within grid.');
        }

        [$xDiff, $yDiff] = match ($orientation) {
            Orientation::North => [0, 1],
            Orientation::East => [1, 0],
            Orientation::South => [0, -1],
            Orientation::West => [-1, 0],
        };

        [$x, $y] = [$position->x + $xDiff, $position->y + $yDiff];

        if ($x < 0) {
            $x = $this->width + $x;
        }

        if ($x >= $this->width) {
            $x = $this->width % $x;
        }

        if ($y < 0) {
            $y = $this->height + $y;
        }

        if ($y >= $this->height) {
            $y = $this->height % $y;
        }

        return new Point($x, $y);
    }

    public function has(Point $point): bool
    {
        return 0 <= $point->x && $point->x <= $this->width
            && 0 <= $point->y && $point->y <= $this->height;
    }
}
