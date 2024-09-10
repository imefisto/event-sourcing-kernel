<?php
namespace Imefisto\EventSourcingKernel\Domain;

abstract class IdentifiesAggregate
{
    public function __construct(private string $value)
    {
    }

    public function toString(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public function equals(IdentifiesAggregate $id)
    {
        return (string) $id == $this->value;
    }

    public abstract static function fromString(string $value): static;
}
