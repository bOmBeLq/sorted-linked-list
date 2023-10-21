<?php

namespace Tests\Shipmonk\SortedLinkedList;

use Shipmonk\SortedLinkedList\Comparator\CaseInsensitiveStringComparator;
use Shipmonk\SortedLinkedList\Comparator\CaseSensitiveStringComparator;
use Shipmonk\SortedLinkedList\Comparator\IntegerComparator;
use Shipmonk\SortedLinkedList\SortedLinkedList;

class SortedLinkedListTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider addProvider
     * @param int[] $integersToAdd
     */
    public function testAdd(array $integersToAdd, array $expectedResult)
    {
        // Arrange
        $list = new SortedLinkedList(new IntegerComparator());

        // Act
        foreach ($integersToAdd as $toAdd) {
            $list->add($toAdd);
        }

        // Assert
        $this->assertFalse($list->isEmpty());
        $this->assertEquals($expectedResult, iterator_to_array($list));
    }

    public function testAddInvalidType()
    {

        // Arrange
        $list = new SortedLinkedList(new IntegerComparator());

        // Assert
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Value not acceptable by Shipmonk\SortedLinkedList\Comparator\IntegerComparator');

        // Act
        $list->add('invalid');
    }

    public static function addProvider(): array
    {
        return [

            // integersToAdd, expectedResult
            [[1], [1]],
            [[1, 2], [1, 2]],
            [[2, 1], [1, 2]],
            [[2, 1, -1, 0], [-1, 0, 1, 2]],
            [[2, 1, 3, 8, 2, 2, 5], [1, 2, 2, 2, 3, 5, 8]], // @todo should we allow duplicates?
        ];
    }

    /**
     * @dataProvider removeProvider
     * @param int[] $integersToAdd
     */
    public function testRemove(array $integersToAdd, array $integersToRemove, array $expectedResult)
    {
        // Arrange
        $list = new SortedLinkedList(new IntegerComparator());
        foreach ($integersToAdd as $toAdd) {
            $list->add($toAdd);
        }

        // Act
        foreach ($integersToRemove as $toRemove) {
            $list->remove($toRemove);
        }

        $this->assertEquals($expectedResult, iterator_to_array($list));
    }

    public static function removeProvider(): array
    {
        return [
            // integersToAdd, integersToRemove, expectedResult
            [[1], [1], []],
            [[1, 2, 3], [1], [2, 3]],
            [[1, 2, 3], [3], [1, 2]],
            [[1, 2, 3], [2], [1, 3]],
            [[1, 2, 3], [1, 2], [3]],
            [[1, 2, 3], [1, 3, 2], []],
        ];
    }

    public function testRemoveNotExisting()
    {
        // Arrange
        $list = new SortedLinkedList(new IntegerComparator());
        $list->add(2);
        $list->add(3);

        // Assert
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage('Value not found in list');

        // Act (yeah it sucks order of Assert/Act is wrong)
        $list->remove(4);
    }

    public function testIsEmpty()
    {
        // Arrange
        $list = new SortedLinkedList(new IntegerComparator());

        // Assert
        $this->assertTrue($list->isEmpty());

        // Act
        $list->add(2);

        // Assert
        $this->assertFalse($list->isEmpty());

        // Act
        $list->remove(2);

        // Assert
        $this->assertTrue($list->isEmpty());
    }

    public function testClear()
    {

        // Arrange
        $list = new SortedLinkedList(new IntegerComparator());
        $list->add(2);
        $list->add(3);

        // Act
        $list->clear();

        // Assert
        $this->assertTrue($list->isEmpty());
    }

    public function testGet()
    {

        // Arrange
        $list = new SortedLinkedList(new IntegerComparator());
        $list->add(2);
        $list->add(3);

        // Assert
        $this->assertEquals(2, $list->get(0));
        $this->assertEquals(3, $list->get(1));
    }


    public function testGetMissing()
    {
        // Arrange
        $list = new SortedLinkedList(new IntegerComparator());
        $list->add(2);
        $list->add(3);

        // Assert
        $this->expectException(\OutOfBoundsException::class);
        $this->expectExceptionMessage('Requested item with key 2 not found in the list');

        // Act (yeah it sucks order of Assert/Act is wrong)
        $list->get(2);
    }

    public function testContains()
    {
        // Arrange
        $list = new SortedLinkedList(new IntegerComparator());
        $list->add(2);
        $list->add(3);

        // Assert
        $this->assertTrue($list->contains(2));
        $this->assertTrue($list->contains(3));
        $this->assertFalse($list->contains(4));
    }

    public function testIndexOf()
    {
        // Arrange
        $list = new SortedLinkedList(new IntegerComparator());
        $list->add(2);
        $list->add(5);

        // Assert
        $this->assertEquals(0, $list->indexOf(2));
        $this->assertEquals(1, $list->indexOf(5));
        $this->assertFalse($list->indexOf(6));
    }

    public function testStringList(): void
    {
        // Arrange
        $list = new SortedLinkedList(new CaseInsensitiveStringComparator());
        $expectedValues = [];

        // Act
        $list->add($value1 = 'some text 1');
        $list->add($value3 = 'some text 3');
        $list->add($value2 = 'some Text 2');
        $list->add($value5 = 'some Text 5');
        $list->remove($value2);

        // Assert
        $this->assertEquals([$value1, $value3, $value5], iterator_to_array($list));
    }
}
