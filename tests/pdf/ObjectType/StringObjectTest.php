<?php

namespace pdf\ObjectType;


use PHPUnit\Framework\TestCase;

class StringObjectTest extends TestCase
{
    public function testSetString()
    {
        $s = new StringObject('test');
        self::assertEquals('test', $s->getString());
    }

    public function testToPdfString()
    {
        $s = new StringObject('test()\\');
        self::assertEquals('(test\\(\\)\\\\)', (string)$s);
    }

}
