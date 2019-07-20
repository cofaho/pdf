<?php


use pdf\Helper\Math;
use PHPUnit\Framework\TestCase;

class MathTest extends TestCase
{

    public function testFloatToStr()
    {
        self::assertEquals('3.12', Math::floatToStr(3.120));
        self::assertEquals('3', Math::floatToStr(3.0));
        setlocale(LC_ALL, 'DE-de');
        self::assertEquals('3.12', Math::floatToStr(3.12));
    }
}
