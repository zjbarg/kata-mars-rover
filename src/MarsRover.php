<?php

declare(strict_types=1);

namespace Zjbarg\Kata\MarsRover;

final class MarsRover
{
    private State $state;

    public function __construct(
        private readonly Grid $grid,
    ) {
        $this->state = State::initial();
    }

    public function execute(string $commands): string
    {
        foreach (str_split($commands) as $index => $command) {
            $next = $this->getNextState($command)
                ?? throw new \Exception(sprintf('Bad command at character %d, expected "M", "L", or "R", got [%s]', $index + 1, $command));

            if ($this->grid->hasObstacleAt($next->position)) {
                return \sprintf('O:%s', $this->state->toString());
            }

            $this->state = $next;
        }

        return $this->state->toString();
    }

    private function getNextState(string $command): ?State
    {
        return match ($command) {
            'M' => $this->state->forward()->wrap($this->grid->width, $this->grid->height),
            'L' => $this->state->left(),
            'R' => $this->state->right(),
            default => null,
        };
    }
}
