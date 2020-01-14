<?php

namespace pdf\DataStructure\NumberTree;


use pdf\ObjectType\IndirectObject;
use pdf\ObjectType\StringObject;
use PHPUnit\Framework\TestCase;

class NodeTest extends TestCase
{
    /**
     * @var Node
     */
    protected $node;

    protected function setUp(): void
    {
        $this->node = new Node();
        $value = new StringObject('someString');

        $leaf1 = new Leaf();
        $leaf1
            ->addNum(12, $value)
            ->addNum(11, $value);

        $leaf2 = new Leaf();
        $leaf2
            ->addNum(21, $value)
            ->addNum(22, $value);

        $this->node
            ->addKid(new IndirectObject(1, 0, $leaf1))
            ->addKid(new IndirectObject(2, 0, $leaf2));
    }

    public function testGetLimits()
    {
        $limits = $this->node->getLimits();

        self::assertEquals(11, $limits[0]);
        self::assertEquals(22, $limits[1]);
    }

    public function test__toString()
    {
        self::assertEquals('<</Kids [1 0 R 2 0 R] /Limits [11 22]>>', (string)$this->node);
    }
}
