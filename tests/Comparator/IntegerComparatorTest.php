<?php

namespace Tests\Shipmonk\SortedLinkedList\Comparator;

use PHPUnit\Framework\TestCase;
use Shipmonk\SortedLinkedList\Comparator\IntegerComparator;
use Shipmonk\SortedLinkedList\Comparator\NumberComparator;

class IntegerComparatorTest extends TestCase
{
    private IntegerComparator $comparator;

    protected function setUp(): void
    {
        $this->comparator = new IntegerComparator();
    }

    /**
     * could use @ dataProvider but let's KISS
     */
    public function testCompare()
    {
        $this->assertTrue($this->comparator->isValueAGreaterThanValueB(2, 1));
        $this->assertTrue($this->comparator->isValueAGreaterThanValueB(5, 1));
        $this->assertFalse($this->comparator->isValueAGreaterThanValueB(-1, 0));
        $this->assertFalse($this->comparator->isValueAGreaterThanValueB(-1, 42));
    }

    public function testIsValueValidType()
    {
        $this->assertTrue($this->comparator->isValueValidType(2));
        $this->assertFalse($this->comparator->isValueValidType(2.5));
        $this->assertFalse($this->comparator->isValueValidType('invalid'));
        $this->assertFalse($this->comparator->isValueValidType(new \stdClass()));
    }
}