<?php
namespace Imefisto\EventSourcingKernel\Domain;

interface EventRepository
{
    public function store(array $events): void;
    public function retrieve(string $aggregateId): array;
}
