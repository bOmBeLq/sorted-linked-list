<?php

namespace Shipmonk\SortedLinkedList\Comparator;

interface ComparatorInterface
{
    public function isValueAGreaterThanValueB(mixed $a, mixed $b): bool; // name of this method may sound hilarious, but it will be way easier to read the code then with simple "compare($a, $b)"

    public function isValueValidType(mixed $value): bool; // theoretically we could implement type checking in isValueAGreaterThanValueB but this would slow down list traversing
}
