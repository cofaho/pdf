<?php


use pdf\Document\Page\Page;
use pdf\Document\Page\Pages;
use pdf\ObjectType\IndirectObject;
use PHPUnit\Framework\TestCase;

class PagesTest extends TestCase
{

    public function testAddKid()
    {
        $pages1 = new Pages();
        $pages2 = new Pages();
        $pages1->addKid((new IndirectObject(0, 0, $pages2)));
        self::assertEquals(0, $pages1->Count);

        $page = new Page();
        $pages2->addKid((new IndirectObject(0, 0, $page)));
        self::assertEquals(1, $pages2->Count);
        self::assertEquals(1, $pages1->Count);
    }
}
