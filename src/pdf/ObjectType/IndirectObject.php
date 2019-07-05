<?php

namespace pdf\ObjectType;


class IndirectObject implements PdfObject
{
    /**
     * @var ObjectReference
     */
    protected $objectReference;
    /**
     * @var mixed
     */
    protected $object;

    public function __construct($objectNumber = 0, $generationNumber = 0, $object = null)
    {
        $this->objectReference = new ObjectReference($objectNumber, $generationNumber);
        if ($object) {
            $this->setObject($object);
        }
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->objectReference->getObjectNumber() . ' ' . $this->objectReference->getGenerationNumber() . " obj\n"
            . $this->getObject()
            . "\nendobj";
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return (string)$this->objectReference;
    }

    /**
     * @param int $generationNumber
     * @return $this
     */
    public function setGenerationNumber(int $generationNumber)
    {
        $this->objectReference->setGenerationNumber($generationNumber);
        return $this;
    }

    /**
     * @return int
     */
    public function getGenerationNumber(): int
    {
        return $this->objectReference->getGenerationNumber();
    }

    /**
     * @param int $objectNumber
     * @return $this
     */
    public function setObjectNumber(int $objectNumber)
    {
        $this->objectReference->setObjectNumber($objectNumber);
        return $this;
    }

    /**
     * @return int
     */
    public function getObjectNumber(): int
    {
        return $this->objectReference->getObjectNumber();
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setObject($value)
    {
        $this->object = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getObject()
    {
        return $this->object;
    }

}
