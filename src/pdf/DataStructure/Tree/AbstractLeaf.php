<?php

namespace pdf\DataStructure\Tree;


use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\DictionaryObject;

/**
 * @property ArrayObject Limits
 */
abstract class AbstractLeaf extends DictionaryObject implements LimitsInterface
{
    /**
     * @return string
     */
    public function __toString(): string
    {
        $this->Limits = $this->getLimits();

        return parent::__toString();
    }
}