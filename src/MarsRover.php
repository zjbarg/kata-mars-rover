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
        $this->position = new Point(0, 0);
        $this->orientation = Orientation::North;
    }

    public function execute(string $commands): string
    {
        foreach (\str_split($commands) as $index => $command) {
            if ('L' === $command) {
                $this->orientation = $this->orientation->turnLeft();
                continue;
            }

            if ('R' === $command) {
                $this->orientation = $this->orientation->turnRight();
                continue;
            }

            if ('M' === $command) {
                $nextPosition = $this->grid->getPositionNextTo($this->position, $this->orientation);

                if ($this->grid->hasObstacleAt($nextPosition)) {
                    return $this->toString(prefix: 'O:');
                }

                $this->position = $nextPosition;
                continue;
            }

            throw new \Exception(sprintf('Invalid command at %d, expected M, L, or R, given [%s]', $index, $command));
        }

        return $this->toString();
    }

    private function toString(string $prefix = ''): string
    {
        return \sprintf(
            '%s%s:%s',
            $prefix,
            $this->position->toString(),
            $this->orientation->toString(),
        );
    }
}
