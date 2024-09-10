<?php
namespace Imefisto\EventSourcingKernel\Domain;

trait EventSourcedReconstitution
{
    public static function reconstituteFromEvents(
        IdentifiesAggregate $id,
        array $events
    ): static {
        $self = new self($id);

        foreach ($events as $event) {
            $self->apply($event);
        }

        return $self;
    }
}
