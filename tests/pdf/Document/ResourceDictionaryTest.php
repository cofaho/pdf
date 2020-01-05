<?php

namespace pdf\Document;


use pdf\Graphic\Pattern\Type1\Type1Pattern;
use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\IndirectObject;
use PHPUnit\Framework\TestCase;

class ResourceDictionaryTest extends TestCase
{

    public function testAddIndirectObject()
    {
        $resource = new ResourceDictionary();
        $shadingPattern = new Type1Pattern();
        $io = new IndirectObject(1, 0, $shadingPattern);
        $resource->addIndirectObject($io);
        self::assertEquals('<</Pattern <</Pattern1 1 0 R>>>>', (string)$resource);
    }

    public function testAddWrongIndirectObject()
    {
        self::expectException('InvalidArgumentException');
        $resource = new ResourceDictionary();
        $wrongObject = new DictionaryObject();
        $io = new IndirectObject(1, 0, $wrongObject);
        $resource->addIndirectObject($io);
    }

    public function test__get()
    {
        $resource = new ResourceDictionary();
        self::assertInstanceOf(DictionaryObject::class, $resource->Font);
        self::assertInstanceOf(DictionaryObject::class, $resource->XObject);
        self::assertInstanceOf(ArrayObject::class, $resource->ProcSet);
    }
}
