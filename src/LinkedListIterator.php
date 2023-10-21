<?php

namespace Shipmonk\SortedLinkedList;

class LinkedListIterator implements \Iterator
{
    protected ?ListItem $currentItem;
    protected int $key = 0;

    public function __construct(protected ?ListItem $firstItem)
    {
        $this->rewind();
    }

    public function current(): mixed
    {
        return $this->currentItem;
    }

    public function next(): void
    {
        $this->key++;
        $this->currentItem = $this->currentItem->getNext();
    }

    public function key(): int
    {
        return $this->key;
    }

    public function valid(): bool
    {
        return $this->currentItem !== null;
    }

    public function rewind(): void
    {
        $this->key = 0;
        $this->currentItem = $this->firstItem;
    }

    public function setFirstItem(?ListItem $firstItem): void
    {
        $this->firstItem = $firstItem;
    }

}
