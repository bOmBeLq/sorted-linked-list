<?php

namespace Tests\Shipmonk\SortedLinkedList\Comparator;

use PHPUnit\Framework\TestCase;
use Shipmonk\SortedLinkedList\Comparator\CaseSensitiveStringComparator;

class CaseSensitiveStringComparatorTest extends TestCase
{
    private CaseSensitiveStringComparator $comparator;

    protected function setUp(): void
    {
        $this->comparator = new CaseSensitiveStringComparator();
    }

    public function testCompare()
    {
        $this->assertTrue($this->comparator->isValueAGreaterThanValueB('Test1', 'Test'));
        $this->assertTrue($this->comparator->isValueAGreaterThanValueB('b', 'a'));
        $this->assertTrue($this->comparator->isValueAGreaterThanValueB('bb', 'aa'));
        $this->assertFalse($this->comparator->isValueAGreaterThanValueB('a', 'b'));
        $this->assertFalse($this->comparator->isValueAGreaterThanValueB('A', 'b'));

        $this->assertTrue($this->comparator->isValueAGreaterThanValueB('a', 'B'), 'Should be case sensitive');
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