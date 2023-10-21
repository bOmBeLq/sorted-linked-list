<?php

namespace Shipmonk\SortedLinkedList\Comparator;

class CaseSensitiveStringComparator implements ComparatorInterface
{
    public function isValueAGreaterThanValueB(mixed $a, mixed $b): bool
    {
        return strcmp($a, $b) > 0;
    }

    public function isValueValidType(mixed $value): bool
    {
        return is_string($value);
    }
}