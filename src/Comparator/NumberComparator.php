<?php

namespace Shipmonk\SortedLinkedList\Comparator;

class NumberComparator implements ComparatorInterface
{
    public function isValueAGreaterThanValueB(mixed $a, mixed $b): bool
    {
        return $a > $b;
    }

    public function isValueValidType(mixed $value): bool
    {
        return is_numeric($value);
    }
}
