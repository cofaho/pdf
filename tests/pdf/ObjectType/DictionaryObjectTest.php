<?php

namespace pdf\ObjectType;


use PHPUnit\Framework\TestCase;

class DictionaryObjectTest extends TestCase
{
    public function testToPdfString()
    {
        $d = new DictionaryObject([
            'name1' => 1,
            'name2' => new StringObject('string'),
        ]);
        $d->name3 = new DictionaryObject(['subname1' => 22]);
        $d->a = new ArrayObject([1, 2]);
        $d->a[] = 3;
        self::assertEquals('<</name1 1 /name2 (string) /name3 <</subname1 22>> /a [1 2 3]>>', (string)$d);
    }

    public function testIndirectObject()
    {
        $d = new DictionaryObject([
            'name1' => 1,
            'name2' => new IndirectObject(1, 0, new StringObject('string')),
        ]);
        self::assertEquals('<</name1 1 /name2 1 0 R>>', (string)$d);
    }

}
