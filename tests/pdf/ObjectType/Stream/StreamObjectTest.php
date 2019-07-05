<?php

namespace pdf\ObjectType\Stream;


use pdf\ObjectType\ArrayObject;
use PHPUnit\Framework\TestCase;

class StreamObjectTest extends TestCase
{
    public function testSetHeader()
    {
        $s = new StreamObject();
        $s->H1 = 'h1';
        $s->H2 = new ArrayObject([1, 2]);
        $s->H2[] = 3;
        self::assertEquals("<</H1 h1 /H2 [1 2 3] /Length 0>>\nstream\n\nendstream", (string)$s);
    }

    public function testSetData()
    {
        $s = new StreamObject();
        $s->data = 'data';
        self::assertEquals('data', $s->data);
    }

    public function testToPdfString()
    {
        $s = new StreamObject();
        $s->data = 'data';
        self::assertEquals("<</Length 4>>\nstream\ndata\nendstream", (string)$s);
    }
}
