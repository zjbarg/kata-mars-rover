<?php

declare(strict_types=1);

namespace Zjbarg\Kata\MarsRover;

final class MarsRover
{
    private readonly Grid $grid;
    private Point $position;
    private Orientation $orientation;

    public function __construct(Grid $grid)
    {
        $this->grid = $grid;
        $this->position = Point::origin();
        $this->orientation = Orientation::North;
    }

    public function execute(string $commands): string
    {
        foreach (\str_split($commands) as $index => $command) {
            switch ($command) {
                case 'L':
                    $this->orientation = $this->orientation->turnLeft();
                    break;
                case 'R':
                    $this->orientation = $this->orientation->turnRight();
                    break;
                case 'M':
                    $nextPosition = $this->grid->getPositionNextTo($this->position, $this->orientation);

                    if ($this->grid->hasObstacleAt($nextPosition)) {
                        return $this->toString(prefix: 'O:');
                    }

                    $this->position = $nextPosition;
                    break;
                default:
                    throw new \Exception(sprintf('Invalid command at %d, expected M, L, or R, given [%s]', $index, $command));
            }
        }

        return $this->toString();
    }

    public function toString(string $prefix = ''): string
    {
        return \sprintf(
            '%s%s:%s',
            $prefix,
            $this->position->toString(),
            $this->orientation->toString(),
        );
    }
}
