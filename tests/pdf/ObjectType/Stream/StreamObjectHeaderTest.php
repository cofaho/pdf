<?php

use pdf\ObjectType\Stream\Filter\Filter;
use pdf\ObjectType\Stream\StreamObjectHeader;
use PHPUnit\Framework\TestCase;

class StreamObjectHeaderTest extends TestCase
{
    public function testSetGetFilters()
    {
        $h = new StreamObjectHeader();
        $h->addFilter(Filter::ASCII_HEX_DECODE);
        $h->addFilter(Filter::FLATE_DECODE);

        self::assertEquals([
            [
                'name' => Filter::FLATE_DECODE,
                'params' => null
            ],
            [
                'name' => Filter::ASCII_HEX_DECODE,
                'params' => null
            ]
        ], $h->getFilters());
    }
}
