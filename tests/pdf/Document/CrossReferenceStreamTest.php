<?php

namespace pdf\Document;


use pdf\ObjectType\ArrayObject;
use PHPUnit\Framework\TestCase;

class CrossReferenceStreamTest extends TestCase
{
    public function test3Columns()
    {
        $s = new CrossReferenceStream();
        $s->W = new ArrayObject([1, 2, 1]);
        $s->addNotCompressedObject(2, 0xABCD);
        $s->addCompressedObject(3, 10, 2);
        $s->addCompressedObject(4, 10, 3);
        $s->addCompressedObject(7, 10, 4);
        $s->addCompressedObject(8, 10, 5);
        $s->__toString();
        self::assertEquals("\x01\xAB\xCD\x00\x02\x00\x0A\x02\x02\x00\x0A\x03\x02\x00\x0A\x04\x02\x00\x0A\x05", $s->getData());
        self::assertEquals([2, 3, 7, 2], $s->Index->toArray());

    }

    public function testMissingColumns()
    {
        $s = new CrossReferenceStream();
        $s->W = new ArrayObject([1, 2, 0]);
        $s->addNotCompressedObject(2, 0xABCD);
        $s->addNotCompressedObject(3, 100);
        $s->addNotCompressedObject(4, 110);
        $s->addNotCompressedObject(7, 120);
        $s->addNotCompressedObject(8, 130);
        $s->__toString();
        self::assertEquals("\x01\xAB\xCD\x01\x00\x64\x01\x00\x6E\x01\x00\x78\x01\x00\x82", $s->getData());
        self::assertEquals([2, 3, 7, 2], $s->Index->toArray());
    }

    public function testToPdfString()
    {
        $s = new CrossReferenceStream();
        $s->W = new ArrayObject([1, 2, 0]);
        self::assertEquals("<</Type /XRef /Index [] /W [1 2 0] /Length 0>>\nstream\n\nendstream", (string)$s);
    }
}
