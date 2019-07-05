<?php

namespace pdf\ObjectType;


use PHPUnit\Framework\TestCase;

class NameObjectTest extends TestCase
{
    public function testSetName()
    {
        $name = new NameObject('test ()<>');
        self::assertEquals('test ()<>', $name->getName());
    }

    public function testEscapeName()
    {
        $name = new NameObject('test (){}[]<>%#\\');
        self::assertEquals('test#20#28#29#7B#7D#5B#5D#3C#3E#25#23#5C', $name->getEscapedName());
    }

    public function testPdfName()
    {
        $name = new NameObject('test');
        self::assertEquals('/test', (string)$name);
    }

}
