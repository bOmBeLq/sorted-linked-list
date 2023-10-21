<?php

namespace Shipmonk\SortedLinkedList\Comparator;

class CaseInsensitiveStringComparator implements ComparatorInterface
{
    public function isValueAGreaterThanValueB(mixed $a, mixed $b): bool
    {
        return strcmp(strtolower($a), strtolower($b)) > 0;
    }

    public function isValueValidType(mixed $value): bool
    {
        return is_string($value);
    }
}
