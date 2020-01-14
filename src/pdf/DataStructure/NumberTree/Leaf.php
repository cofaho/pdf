<?php

namespace pdf\DataStructure\NumberTree;


use pdf\DataStructure\Tree\AbstractLeaf;
use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\IndirectObject;
use pdf\ObjectType\PdfObject;

/**
 * @property ArrayObject Nums
 * @property ArrayObject Limits
 */
class Leaf extends AbstractLeaf
{
    protected $isSorted = true;

    /**
     * @param int $number
     * @param PdfObject|IndirectObject $value
     * @return $this
     */
    public function addNum(int $number, $value)
    {
        if (!$this->Nums) {
            $this->Nums = new ArrayObject();
        }

        $this->Nums[] = $number;
        $this->Nums[] = $value;

        $this->isSorted = false;

        return $this;
    }

    /**
     * @return ArrayObject
     */
    public function getLimits(): ArrayObject
    {
        $result = new ArrayObject();
        if (count($this->Nums) === 0) {
            return $result;
        }

        if (!$this->isSorted) {
            $this->Nums = $this->getNums();
            $this->isSorted = true;
        }

        $result[] = $this->Nums[0];
        $result[] = $this->Nums[count($this->Nums) - 2];

        return $result;
    }

    /**
     * @return ArrayObject
     */
    public function getNums(): ArrayObject
    {
        $result = new ArrayObject();

        if (count($this->Nums) === 0) {
            return $result;
        }

        $nums = [];
        $i = 0;
        while (isset($this->Nums[$i])) {
            $key = $this->Nums[$i];
            $nums[$key] = $this->Nums[$i + 1];
            $i += 2;
        }
        ksort($nums);

        foreach ($nums as $key => $value) {
            $result[] = $key;
            $result[] = $value;
        }

        return $result;
    }
}