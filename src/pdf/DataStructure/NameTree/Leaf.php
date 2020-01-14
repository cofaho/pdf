<?php

namespace pdf\DataStructure\NameTree;


use pdf\DataStructure\Tree\AbstractLeaf;
use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\IndirectObject;
use pdf\ObjectType\PdfObject;
use pdf\ObjectType\StringObject;

/**
 * @property ArrayObject Names
 * @property ArrayObject Limits
 */
class Leaf extends AbstractLeaf
{
    protected $isSorted = true;

    /**
     * @param string|StringObject $name
     * @param PdfObject|IndirectObject $value
     * @return $this
     */
    public function addName($name, $value)
    {
        $name = $name instanceof StringObject ? $name : new StringObject($name);

        if (!$this->Names) {
            $this->Names = new ArrayObject();
        }

        $this->Names[] = $name;
        $this->Names[] = $value;

        $this->isSorted = false;

        return $this;
    }

    /**
     * @return ArrayObject
     */
    public function getLimits(): ArrayObject
    {
        $result = new ArrayObject();
        if (count($this->Names) === 0) {
            return $result;
        }

        if (!$this->isSorted) {
            $this->Names = $this->getNames();
            $this->isSorted = true;
        }

        $result[] = $this->Names[0];
        $result[] = $this->Names[count($this->Names) - 2];

        return $result;
    }

    /**
     * @return ArrayObject
     */
    public function getNames(): ArrayObject
    {
        $result = new ArrayObject();

        if (count($this->Names) === 0) {
            return $result;
        }

        $names = [];
        $i = 0;
        while (isset($this->Names[$i])) {
            $str = $this->Names[$i]->getString();
            $names[$str] = $this->Names[$i + 1];
            $i += 2;
        }
        ksort($names);

        foreach ($names as $key => $value) {
            $result[] = new StringObject($key);
            $result[] = $value;
        }

        return $result;
    }
}