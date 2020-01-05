<?php

namespace pdf\ObjectType\Stream;


use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\Stream\Filter\Filter;
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

    public function testApplyFilters()
    {
        $s = new StreamObject();
        $s->setData('data')->addFilter(Filter::ASCII_HEX_DECODE);
        self::assertEquals("<</Filter [/ASCIIHexDecode] /DL 4 /Length 9>>\nstream\n64617461>\nendstream", (string)$s);
        $s->setApplyFilters(false);
        self::assertEquals("<</Filter [/ASCIIHexDecode] /DL 4 /Length 4>>\nstream\ndata\nendstream", (string)$s);
    }


}
