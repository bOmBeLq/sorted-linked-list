<?php

namespace Tests\Shipmonk\SortedLinkedList\Comparator;

use PHPUnit\Framework\TestCase;
use SebastianBergmann\Comparator\Comparator;
use Shipmonk\SortedLinkedList\Comparator\NumberComparator;
use Shipmonk\SortedLinkedList\Comparator\CaseInsensitiveStringComparator;

class CaseInsensitiveStringComparatorTest extends TestCase
{
    private CaseInsensitiveStringComparator $comparator;

    protected function setUp(): void
    {
        $this->comparator = new CaseInsensitiveStringComparator();
    }

    public function testCompare()
    {
        $this->assertTrue($this->comparator->isValueAGreaterThanValueB('Test1', 'Test'));
        $this->assertTrue($this->comparator->isValueAGreaterThanValueB('b', 'a'));
        $this->assertTrue($this->comparator->isValueAGreaterThanValueB('bb', 'aa'));
        $this->assertFalse($this->comparator->isValueAGreaterThanValueB('a', 'b'));
        $this->assertFalse($this->comparator->isValueAGreaterThanValueB('A', 'b'));

        $this->assertFalse($this->comparator->isValueAGreaterThanValueB('a', 'B'), 'Should be case insensitive');
    }

    public function testIsValueValidType()
    {
        $this->assertTrue($this->comparator->isValueValidType('test'));
        $this->assertTrue($this->comparator->isValueValidType('a'));
        $this->assertFalse($this->comparator->isValueValidType(5));
        $this->assertFalse($this->comparator->isValueValidType(5.5));
        $this->assertFalse($this->comparator->isValueValidType(new \stdClass()));
    }
}