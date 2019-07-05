<?php

namespace pdf\Document;


use pdf\ObjectType\IndirectObject;
use pdf\ObjectType\StringObject;
use PHPUnit\Framework\TestCase;

class ObjectStreamTest extends TestCase
{
    public function testToPdfString()
    {
        $os = new ObjectStream();
        $os->addObject(new IndirectObject(1, 0, 5));
        $os->addObject(new IndirectObject(2, 0, new StringObject('string')));
        self::assertEquals("<</Type /ObjStm /N 2 /First 8 /Length 17>>\nstream\n1 0 2 1\n5(string)\nendstream", (string)$os);
    }

    public function testInvalidObjects()
    {
        self::expectException('InvalidArgumentException');
        $os = new ObjectStream();
        $os->addObject(new IndirectObject(1, 1, 5));
    }

}
