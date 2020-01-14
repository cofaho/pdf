<?php

namespace pdf\DataStructure\Tree;


use pdf\ObjectType\ArrayObject;

/**
 * @property ArrayObject Kids
 * @property ArrayObject Limits
 */
class AbstractNode extends AbstractRoot implements LimitsInterface
{
    /**
     * @return string
     */
    public function __toString(): string
    {
        $this->Limits = $this->getLimits();

        return parent::__toString();
    }

    /**
     * @return ArrayObject
     */
    public function getLimits(): ArrayObject
    {
        $result = new ArrayObject();
        if (!$this->Kids) {
            return $result;
        }

        list($min, $max) = $this->Kids[0]->getObject()->getLimits();
        foreach ($this->Kids as $kid) {
            list($_min, $_max) = $kid->getObject()->getLimits();
            $min = min($min, $_min);
            $max = max($max, $_max);
        }

        $result[] = $min;
        $result[] = $max;

        return $result;
    }
}