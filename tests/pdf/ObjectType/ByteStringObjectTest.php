<?php

namespace pdf\ObjectType;


use PHPUnit\Framework\TestCase;

class ByteStringObjectTest extends TestCase
{
    public function testSetString()
    {
        $s = new ByteStringObject("\x00\x01\x02\x03\x04\x05\xFF");
        self::assertEquals("\x00\x01\x02\x03\x04\x05\xFF", $s->getString());
    }

    public function testToPdfString()
    {
        $s = new ByteStringObject("\x00\x01\x02\x03\x04\x05\xFF\n\r\t\x08\f()\\");
        self::assertEquals('<000102030405ff0a0d09080c28295c>', (string)$s);
    }

}
