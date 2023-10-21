<?php

namespace Shipmonk\SortedLinkedList;

class ListItem
{
    public function __construct(
        private readonly mixed $value,
        private ?ListItem      $next = null
    ) {
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function getNext(): ?ListItem
    {
        return $this->next;
    }

    public function setNext(?ListItem $next): void
    {
        $this->next = $next;
    }
}
