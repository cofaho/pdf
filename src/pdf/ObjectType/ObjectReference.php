<?php

namespace pdf\ObjectType;


class ObjectReference implements PdfObject
{
    /**
     * @var int
     */
    protected $objectNumber = 0;
    /**
     * @var int
     */
    protected $generationNumber = 0;

    public function __construct(int $objectNumber = 0, int $generationNumber = 0)
    {
        $this->objectNumber = $objectNumber;
        $this->generationNumber = $generationNumber;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->objectNumber . ' ' . $this->generationNumber . ' R';
    }

    /**
     * @param int $generationNumber
     * @return $this
     */
    public function setGenerationNumber(int $generationNumber)
    {
        $this->generationNumber = $generationNumber;
        return $this;
    }

    /**
     * @return int
     */
    public function getGenerationNumber(): int
    {
        return $this->generationNumber;
    }

    /**
     * @param int $objectNumber
     * @return $this
     */
    public function setObjectNumber(int $objectNumber)
    {
        $this->objectNumber = $objectNumber;
        return $this;
    }

    /**
     * @return int
     */
    public function getObjectNumber(): int
    {
        return $this->objectNumber;
    }

}
