<?php

namespace pdf\Document;


use PHPUnit\Framework\TestCase;

class TrailerTest extends TestCase
{
    public function testToPdfString()
    {
        $t = new Trailer();
        $t->Size = 3;
        $t->Root = '0 1 R';
        $t->ID = 123;
        $t->xrefOffset = 500;

        self::assertEquals("trailer\n<</Size 3 /Root 0 1 R /ID [<313233> <313233>]>>\nstartxref\n500\n%%EOF\n", (string)$t);
    }
}
