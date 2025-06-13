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
            $next = match ($command) {
                'M' => $this->state->forward()->wrap($this->grid->width, $this->grid->height),
                'R' => $this->state->right(),
                'L' => $this->state->left(),
                default => throw new \Exception(sprintf('Bad command at index %d, %s given', $index, $command)),
            };

            if ($this->grid->hasObstacleAt($next->position)) {
                return sprintf('O:%s', $this->state->toString());
            }

            $this->state = $next;
        }

        return $this->state->toString();
    }
}
