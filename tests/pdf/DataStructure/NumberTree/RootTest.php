<?php

namespace pdf\DataStructure\NumberTree;


use pdf\ObjectType\IndirectObject;
use pdf\ObjectType\StringObject;
use PHPUnit\Framework\TestCase;

class RootTest extends TestCase
{
    /**
     * @var Root
     */
    protected $root;

    protected function setUp(): void
    {
        $this->root = new Root();

        $node = new Node();
        $value = new StringObject('someString');

        $leaf1 = new Leaf();
        $leaf1
            ->addNum(12, $value)
            ->addNum(11, $value);

        $leaf2 = new Leaf();
        $leaf2
            ->addNum(21, $value)
            ->addNum(22, $value);

        $node
            ->addKid(new IndirectObject(1, 0, $leaf1))
            ->addKid(new IndirectObject(2, 0, $leaf2));

        $this->root->addKid(new IndirectObject(3, 0, $node));
    }

    public function testAddKid()
    {
        self::assertEquals(1, count($this->root->Kids));

        $value = new StringObject('someString');
        $leaf3 = new Leaf();
        $leaf3
            ->addNum(32, $value)
            ->addNum(31, $value);

        $this->root->addKid(new IndirectObject(4, 0, $leaf3));

        self::assertEquals(2, count($this->root->Kids));
    }

    public function testAddInvalidKid()
    {
        self::expectException(\InvalidArgumentException::class);
        $this->root->addKid(new IndirectObject(4, 0, new StringObject('string')));
    }

    public function test_toString()
    {
        self::assertEquals('<</Kids [3 0 R]>>', (string)$this->root);
    }
}
