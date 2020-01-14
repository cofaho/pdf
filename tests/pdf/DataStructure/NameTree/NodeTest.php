<?php


use pdf\DataStructure\NameTree\Leaf;
use pdf\DataStructure\NameTree\Node;
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
            ->addName('leaf1-name2', $value)
            ->addName('leaf1-name1', $value);

        $leaf2 = new Leaf();
        $leaf2
            ->addName('leaf2-name1', $value)
            ->addName('leaf2-name2', $value);

        $this->node
            ->addKid(new IndirectObject(1, 0, $leaf1))
            ->addKid(new IndirectObject(2, 0, $leaf2));
    }

    public function testGetLimits()
    {
        $limits = $this->node->getLimits();

        self::assertEquals('leaf1-name1', $limits[0]->getString());
        self::assertEquals('leaf2-name2', $limits[1]->getString());
    }

    public function test__toString()
    {
        self::assertEquals('<</Kids [1 0 R 2 0 R] /Limits [(leaf1-name1) (leaf2-name2)]>>', (string)$this->node);
    }
}
