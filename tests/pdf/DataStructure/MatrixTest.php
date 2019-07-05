<?php

namespace pdf\DataStructure;


use PHPUnit\Framework\TestCase;

class MatrixTest extends TestCase
{
    public function testSetGetElement()
    {
        $m = new Matrix(2, 2);
        $m->setElem(1, 0, 5);
        self::assertEquals(5, $m->getElem(1, 0));
        $m = new Matrix(2, 2, [[5, 6], [7, 8]]);
        self::assertEquals(8, $m->getElem(1, 1));
    }

    public function testAddMatrices()
    {
        $m1 = new Matrix(2, 2, [[1, 2], [3, 4]]);
        $m2 = new Matrix(2, 2, [[5, 6], [7, 8]]);
        $m3 = $m1->add($m2);
        self::assertEquals([[6, 8], [10, 12]], $m3->asArray());
    }

    public function testSubtractMatrices()
    {
        $m1 = new Matrix(2, 2, [[1, 2], [3, 4]]);
        $m2 = new Matrix(2, 2, [[5, 6], [7, 8]]);
        $m3 = $m1->subtract($m2);
        self::assertEquals([[-4, -4], [-4, -4]], $m3->asArray());
    }

    public function testScalarMultiply()
    {
        $m1 = new Matrix(2, 2, [[1, 2], [3, 4]]);
        $m2 = $m1->scalarMultiply(5);
        self::assertEquals([[5, 10], [15, 20]], $m2->asArray());
    }

    public function testMultiplyMatrices()
    {
        $m1 = new Matrix(2, 2, [[2, 1], [3, 5]]);
        $m2 = new Matrix(2, 2, [[-2, 3], [4, -1]]);
        $m3 = $m1->multiply($m2);
        self::assertEquals([[0, 5], [14, 4]], $m3->asArray());
    }

}
