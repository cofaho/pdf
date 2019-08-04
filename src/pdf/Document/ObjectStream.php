<?php

namespace pdf\Document;


use InvalidArgumentException;
use pdf\Document\Encryption\EncryptionDictionary;
use pdf\ObjectType\IndirectObject;
use pdf\ObjectType\Stream\StreamObject;

/**
 * @property ObjectStreamHeader $header
 * @method ObjectStreamHeader getHeader()
 */
class ObjectStream extends StreamObject
{
    /**
     * @var IndirectObject[]
     */
    protected $objects = [];

    public function __construct()
    {
        parent::__construct(new ObjectStreamHeader());
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $body = [];
        $offsets = [];
        $currentOffset = 0;
        foreach ($this->objects as $objectNumber => $object) {
            $offsets[] = $objectNumber;
            $offsets[] = $currentOffset;
            $strObj = (string)$object;
            $currentOffset += mb_strlen($strObj, '8bit');
            $body[] = $strObj;
        }
        $strOffsets = implode(' ', $offsets) . "\n";
        array_unshift($body, $strOffsets);
        $this->data = implode('', $body);

        $this->header->N = count($this->objects);
        $this->header->First = mb_strlen($strOffsets, '8bit');

        return parent::__toString();
    }

    /**
     * @param IndirectObject $iObject
     * @throws InvalidArgumentException
     */
    public function addObject(IndirectObject $iObject)
    {
        $object = $iObject->getObject();
        if ($object instanceof StreamObject || $object instanceof EncryptionDictionary) {
            throw new InvalidArgumentException(get_class($object) . ' shall not be stored in object stream');
        }
        if ($iObject->getGenerationNumber() !== 0) {
            throw new InvalidArgumentException('Objects with a generation number other than zero shall not be stored in object stream');
        }
        $objectNumber = $iObject->getObjectNumber();
        $this->objects[$objectNumber] = $object;
    }

}
