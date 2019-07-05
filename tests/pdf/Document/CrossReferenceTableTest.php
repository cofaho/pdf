<?php

namespace pdf\Document;


use PHPUnit\Framework\TestCase;

class CrossReferenceTableTest extends TestCase
{
    public function testToPdfString()
    {
        $t = new CrossReferenceTable();
        $t->addOffset(20);
        $t->addOffset(30);

        self::assertEquals("\nxref\n0 3\n0000000000 65535 f \n0000000020 00000 n \n0000000030 00000 n \n", (string)$t);
    }

    public function testOffsetSets()
    {
        $t = new CrossReferenceTable();
        $t->addOffset(10, 1);
        $t->addOffset(20, 2);
        $t->addOffset(30, 5);
        $t->addOffset(40, 6);

        self::assertEquals("\nxref\n0 3\n0000000000 65535 f \n0000000010 00000 n \n0000000020 00000 n \n5 2\n0000000030 00000 n \n0000000040 00000 n \n", (string)$t);
    }

    public function testNumberOfObjects()
    {
        $t = new CrossReferenceTable();
        $t->addOffset(10, 1);
        $t->addOffset(20, 2);

        self::assertEquals(3, $t->getNumberOfObjects());
    }
}
