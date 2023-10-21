<?php

namespace Shipmonk\SortedLinkedList;

use Shipmonk\SortedLinkedList\Comparator\ComparatorInterface;

class SortedLinkedList implements \IteratorAggregate
{
    protected ?ListItem $firstItem = null;

    /**
     * @var LinkedListIterator|null|ListItem[]
     */
    protected ?LinkedListIterator $itemIterator = null; // used internally by sortedLinkedList
    protected ?LinkedListValueIterator $valueIterator = null; // for external use

    public function __construct(private ComparatorInterface $comparator)
    {
    }


    public function isEmpty(): bool
    {
        return $this->firstItem === null;
    }

    public function add(mixed $newValue): void
    {
        if (!$this->comparator->isValueValidType($newValue)) {
            throw new \InvalidArgumentException('Value not acceptable by ' . get_class($this->comparator));
        }
        $newItem = new ListItem($newValue);
        if ($this->isEmpty()) {
            $this->firstItem = $newItem;
            $this->updateIterator();

            return;
        }

        if ($newValue <= $this->firstItem->getValue()) {

            $newItem->setNext($this->firstItem);
            $this->firstItem = $newItem;
            $this->updateIterator();
            return;
        }


        foreach ($this->itemIterator as $item) {
            if (
                $this->comparator->isValueAGreaterThanValueB($newValue, $item->getValue()) &&
                ($item->getNext() === null || $this->comparator->isValueAGreaterThanValueB($item->getNext()->getValue(), $newValue))

            ) {

                $newItem->setNext($item->getNext());
                $item->setNext($newItem);

                break;
            }
        }

        $this->updateIterator();
    }

    /**
     * @throws \UnexpectedValueException
     */
    public function remove(mixed $value): void
    {
        /** @var ListItem $prevItem */
        $prevItem = null;

        foreach ($this->itemIterator as $item) {
            if ($item->getValue() === $value) {

                if ($prevItem) {
                    $prevItem->setNext($item->getNext());
                } else {
                    $this->firstItem = $item->getNext();
                }

                $this->updateIterator();
                return;
            }
            $prevItem = $item;
        }
        throw new \UnexpectedValueException('Value not found in list');
    }

    public function clear(): void
    {
        $this->firstItem = null;
        $this->updateIterator();
    }

    public function contains(int $value): bool
    {
        foreach ($this->itemIterator as $item) {
            if ($item->getValue() === $value) {
                return true;
            }
        }
        return false;
    }

    /**
     * @throws \OutOfBoundsException
     */
    public function get(int $index): mixed
    {
        $currentItemIndex = 0;
        foreach ($this->itemIterator as $item) {
            if ($currentItemIndex === $index) {
                return $item->getValue();
            }
            $currentItemIndex++;
        }
        throw new \OutOfBoundsException(sprintf('Requested item with key %s not found in the list', $index));
    }

    /**
     * @return int|bool index of item or false if not found
     */
    public function indexOf(mixed $value): int|bool
    {
        $currentItemIndex = 0;
        foreach ($this->itemIterator as $item) {
            if ($item->getValue() === $value) {
                return $currentItemIndex;
            }
            $currentItemIndex++;
        }
        return false;
    }


    /**
     * @return LinkedListValueIterator
     */
    public function getIterator(): LinkedListValueIterator
    {
        if (!$this->itemIterator) {
            $this->itemIterator = new LinkedListIterator($this->firstItem);
            $this->valueIterator = new LinkedListValueIterator($this->itemIterator);
        }
        return $this->valueIterator;
    }

    private function updateIterator(): void // could get rid of this method but would have to expose LinkedList::getFirst() which I didnt want to do
    {
        $this->getIterator()->setFirstItem($this->firstItem);
    }
}