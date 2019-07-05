<?php

namespace pdf\ObjectType;


use PHPUnit\Framework\TestCase;

class ArrayObjectTest extends TestCase
{
    public function testCount()
    {
        $a = new ArrayObject([1, 2]);
        $a[] = 3;
        self::assertEquals(3, count($a));
    }

    public function testToPdfString()
    {
        $a = new ArrayObject([
            549, 3.14, false, null, new StringObject('string'), new NameObject('name')
        ]);
        $a[] = new ArrayObject([1, 2, 3]);
        self::assertEquals('[549 3.14 false null (string) /name [1 2 3]]', (string)$a);
    }

    public function testLoop()
    {
        $a = new ArrayObject([1, 2, 3]);
        $b = [];
        foreach ($a as $item) {
            $b[] = $item;
        }
        self::assertEquals([1, 2, 3], $b);
    }

}
