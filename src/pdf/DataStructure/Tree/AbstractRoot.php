<?php

namespace pdf\DataStructure\Tree;


use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\IndirectObject;

/**
 * @property ArrayObject Kids
 */
abstract class AbstractRoot extends DictionaryObject
{
    /**
     * @param IndirectObject $io
     * @return $this
     */
    public function addKid(IndirectObject $io)
    {
        if (!$this->Kids) {
            $this->Kids = new ArrayObject();
        }

        $object = $io->getObject();
        if (!($object instanceof LimitsInterface)) {
            throw new \InvalidArgumentException('Object should be instance of Node or Leaf');
        }

        $this->Kids[] = $io;
        return $this;
    }
}