<?php
namespace Imefisto\EventSourcingKernel\Domain;

abstract class AggregateRoot
{
    private $version = 0;
    private $recordedEvents = [];

    public function __construct(public readonly IdentifiesAggregate $aggregateRootId)
    {
    }

    public function getVersion(): int
    {
        return $this->version;
    }

    public function recordThat(DomainEvent $event): void
    {
        $this->recordedEvents[] = $event;
        $this->apply($event);
    }

    protected function apply(DomainEvent $event)
    {
        $this->version++;
        $classParts = explode('\\', get_class($event));
        $this->{'apply' . end($classParts)}($event);
    }

    public function getRecordedEvents(): array
    {
        return $this->recordedEvents;
    }

    public function clearRecordedEvents(): void
    {
        $this->recordedEvents = [];
    }

    public abstract static function reconstituteFromEvents(
        IdentifiesAggregate $id,
        array $events
    ): self;
}
