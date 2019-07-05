<?php

namespace pdf\ObjectType\Stream\Filter;


use PHPUnit\Framework\TestCase;

class ASCIIHexTest extends TestCase
{
    public function testEncode()
    {
        $encoded = ASCIIHex::encode("123\x10");
        self::assertEquals('31323310>', $encoded);
    }

    public function testDecode()
    {
        $decoded = ASCIIHex::decode('3132331>');
        self::assertEquals("123\x10", $decoded);
    }
}
