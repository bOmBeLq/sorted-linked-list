<?php

namespace Tests\Shipmonk\SortedLinkedList\Comparator;

use PHPUnit\Framework\TestCase;
use SebastianBergmann\Comparator\Comparator;
use Shipmonk\SortedLinkedList\Comparator\NumberComparator;

class NumberComparatorTest extends TestCase
{
    private NumberComparator $comparator;

    protected function setUp(): void
    {
        $this->comparator = new NumberComparator();
    }

    public function testCompare()
    {
        $this->assertTrue($this->comparator->isValueAGreaterThanValueB(2, 1));
        $this->assertTrue($this->comparator->isValueAGreaterThanValueB(2.2, 1));
        $this->assertFalse($this->comparator->isValueAGreaterThanValueB(-1, 1.5));
    }

    public function testIsValueValidType()
    {
        $this->assertTrue($this->comparator->isValueValidType(2));
        $this->assertTrue($this->comparator->isValueValidType(2.5));
        $this->assertFalse($this->comparator->isValueValidType('invalid'));
        $this->assertFalse($this->comparator->isValueValidType(new \stdClass()));
    }
}