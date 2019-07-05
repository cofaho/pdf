<?php

namespace pdf\ObjectType;


use PHPUnit\Framework\TestCase;

class IndirectObjectTest extends TestCase
{
    public function testSetObject()
    {
        $io = new IndirectObject(1, 0, 2);
        self::assertEquals(2, $io->getObject());
    }

    public function testToPdfString()
    {
        $io = new IndirectObject(1, 0, 2);
        self::assertEquals("1 0 obj\n2\nendobj", (string)$io);
    }
}
