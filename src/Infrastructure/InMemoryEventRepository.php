<?php
namespace Imefisto\EventSourcingKernel\Infrastructure;

use Imefisto\EventSourcingKernel\Domain\EventRepository;

class InMemoryEventRepository implements EventRepository
{
    private array $events = [];

    public function store(array $events): void
    {
        $this->events = array_merge($this->events, $events);
    }

    public function retrieve(string $aggregateId): array
    {
        return array_filter(
            $this->events,
            function ($item) use ($aggregateId) {
                return $item->getAggregateId() === $aggregateId;
            }
        );
    }

    public function countEvents(): int
    {
        return count($this->events);
    }
}
