<?php

namespace Shipmonk\SortedLinkedList;

/**
 * This iterator simply modified internal LinkedListIterator which iterates over ListItem instances
 * to iterate over ListItem values instead (for external use)
 */
class LinkedListValueIterator implements \Iterator
{
    public function __construct(
        private LinkedListIterator $baseIterator
    ) {
    }

    public function current(): mixed
    {
        return $this->baseIterator->current()->getValue();
    }

    public function next(): void
    {
        $this->baseIterator->next();
    }

    public function key(): int
    {
        return $this->baseIterator->key();
    }

    public function valid(): bool
    {
        return $this->baseIterator->valid();
    }

    public function rewind(): void
    {
        $this->baseIterator->rewind();
    }

    public function setFirstItem(?ListItem $firstItem): void
    {
        $this->baseIterator->setFirstItem($firstItem);
    }


}
