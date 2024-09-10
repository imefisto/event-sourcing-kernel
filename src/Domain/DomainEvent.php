<?php
namespace Imefisto\EventSourcingKernel\Domain;

interface DomainEvent
{
    public function getAggregateId(): string;
    public function toPayload(): array;
    public static function fromPayload(array $payload): static;
}
