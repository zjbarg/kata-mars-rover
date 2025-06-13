<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;
use Zjbarg\Kata\MarsRover\Grid;
use Zjbarg\Kata\MarsRover\MarsRover;
use Zjbarg\Kata\MarsRover\Point;

final class MarsRoverTest extends TestCase
{
    #[Test]
    #[TestWith(['0:0:N', ''])]
    #[TestWith(['0:2:N', 'MM'], 'moves up')]
    #[TestWith(['2:3:N', 'MMRMMLM'])]
    #[TestWith(['0:0:N', 'MMMMMMMMMM'], 'wraps around')]
    public function commandWithoutObstacles(string $expected_state, string $command): void
    {
        $rover = new MarsRover(
            Grid::square(10),
        );

        $this->assertEquals($expected_state, $rover->execute($command));
    }

    #[Test]
    #[TestWith(['O:0:2:N', 'MMMM'])]
    public function commandWithObstacles(string $expected_state, string $command): void
    {
        $rover = new MarsRover(
            Grid::square(10)->withObstacles(new Point(0, 3))
        );

        $this->assertEquals($expected_state, $rover->execute($command));
    }
}
