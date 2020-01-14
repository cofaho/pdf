<?php

namespace pdf\DataStructure\NumberTree;


use pdf\ObjectType\IndirectObject;
use pdf\ObjectType\StringObject;
use PHPUnit\Framework\TestCase;

class LeafTest extends TestCase
{
    public function test__toString()
    {
        $leaf = new Leaf();
        $leaf->addNum(2, new StringObject('someValue2'));
        $leaf->addNum(1, new IndirectObject(1, 0, new StringObject('someValue1')));

        self::assertEquals('<</Nums [1 1 0 R 2 (someValue2)] /Limits [1 2]>>', (string)$leaf);
    }

    public function testGetLimits()
    {
        $leaf = new Leaf();
        $value = new StringObject('someValue');
        $leaf->addNum(1, $value);
        $leaf->addNum(3, $value);
        $leaf->addNum(2, $value);

        $limits = $leaf->getLimits();

        self::assertEquals(1, $limits[0]);
        self::assertEquals(3, $limits[1]);
    }

    public function testGetNames()
    {
        $leaf = new Leaf();
        $value = new StringObject('someValue');
        $leaf->addNum(1, $value);
        $leaf->addNum(3, $value);
        $leaf->addNum(2, $value);

        $numbers = $leaf->getNums();

        self::assertEquals(1, $numbers[0]);
        self::assertEquals(2, $numbers[2]);
        self::assertEquals(3, $numbers[4]);
    }

    public function testAddName()
    {
        $leaf = new Leaf();
        $leaf->addNum(1, new StringObject('someValue'));
        self::assertEquals(1, $leaf->Nums[0]);
    }
}
