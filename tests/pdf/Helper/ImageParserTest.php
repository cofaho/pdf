<?php


use pdf\Helper\ImageParser;
use PHPUnit\Framework\TestCase;

class ImageParserTest extends TestCase
{
    public function testSimpleJpeg()
    {
        $parsed = new ImageParser(__DIR__ . '/../../assets/1x1.jpg');
        $image = $parsed->getImage();
        self::assertEquals(1, $image->getHeader()->Width);
        self::assertEquals(1, $image->getHeader()->Height);
        self::assertEquals('/DeviceRGB', $image->getHeader()->ColorSpace);
        self::assertEquals('/DCTDecode', $image->getHeader()->Filter);
    }

    public function testSimplePng()
    {
        $parsed = new ImageParser(__DIR__ . '/../../assets/1x1.png');
        $image = $parsed->getImage();
        self::assertEquals(1, $image->getHeader()->Width);
        self::assertEquals(1, $image->getHeader()->Height);
        self::assertEquals('/DeviceRGB', $image->getHeader()->ColorSpace);
        self::assertEquals('/FlateDecode', $image->getHeader()->Filter);
    }


}
