<?php

namespace Shipmonk\SortedLinkedList\Comparator;

class IntegerComparator implements ComparatorInterface
{
    public function isValueAGreaterThanValueB(mixed $a, mixed $b): bool
    {
        return $a >= $b;
    }

    public function isValueValidType(mixed $value): bool
    {
        return is_int($value);
    }
}
