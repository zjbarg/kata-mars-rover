<?php

declare(strict_types=1);

namespace Zjbarg\Kata\MarsRover;

final class MarsRover
{
    private State $state;

    public function __construct(
        private readonly Grid $grid,
    ) {
        $this->state = new State(
            Point::origin(),
            Orientation::North,
        );
    }

    public function execute(string $commands): string
    {
        $this->failOnInvalidCommandString($commands);

        foreach (\str_split($commands) as $command) {
            $next = $this->getNextState($command);

            if ($this->grid->hasObstacleAt($next->position)) {
                return $this->state->toString(prefix: 'O:');
            }

            $this->state = $next;
        }

        return $this->state->toString();
    }

    private function failOnInvalidCommandString(string $commands): void
    {
        if (1 !== \preg_match('/^[MLR]+$|^$/', $commands)) {
            throw new \Exception('Bad input');
        }
    }

    private function getNextState(string $command): State
    {
        return match ($command) {
            'M' => $this->state->forward()->wrap($this->grid->width, $this->grid->height),
            'L' => $this->state->left(),
            'R' => $this->state->right(),
        };
    }
}
