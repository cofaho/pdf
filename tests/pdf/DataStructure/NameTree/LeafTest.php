<?php

use pdf\DataStructure\NameTree\Leaf;
use pdf\ObjectType\IndirectObject;
use pdf\ObjectType\StringObject;
use PHPUnit\Framework\TestCase;

class LeafTest extends TestCase
{
    public function test__toString()
    {
        $leaf = new Leaf();
        $leaf->addName('someName2', new StringObject('someValue2'));
        $leaf->addName('someName1', new IndirectObject(1, 0, new StringObject('someValue1')));

        self::assertEquals('<</Names [(someName1) 1 0 R (someName2) (someValue2)] /Limits [(someName1) (someName2)]>>', (string)$leaf);
    }

    public function testGetLimits()
    {
        $leaf = new Leaf();
        $value = new StringObject('someValue');
        $leaf->addName('someName1', $value);
        $leaf->addName('someName3', $value);
        $leaf->addName('someName2', $value);

        $limits = $leaf->getLimits();

        self::assertEquals('someName1', $limits[0]->getString());
        self::assertEquals('someName3', $limits[1]->getString());
    }

    public function testGetNames()
    {
        $leaf = new Leaf();
        $value = new StringObject('someValue');
        $leaf->addName('someName1', $value);
        $leaf->addName('someName3', $value);
        $leaf->addName('someName2', $value);

        $names = $leaf->getNames();

        self::assertEquals('someName1', $names[0]->getString());
        self::assertEquals('someName2', $names[2]->getString());
        self::assertEquals('someName3', $names[4]->getString());
    }

    public function testAddName()
    {
        $leaf = new Leaf();
        $leaf->addName('someName', new StringObject('someValue'));
        self::assertInstanceOf(StringObject::class, $leaf->Names[0]);
        self::assertEquals('someName', $leaf->Names[0]->getString());
    }
}
