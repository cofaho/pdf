<?php

namespace pdf\Document;


use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\NameObject;
use pdf\ObjectType\Stream\StreamObject;

/**
 * @property-read NameObject Type
 * @property integer Size
 * @property ArrayObject Index
 * @property integer Prev
 * @property ArrayObject W
 * @property CrossReferenceStreamHeader $header
 */
class CrossReferenceStream extends StreamObject
{
    protected $objects = [];

    protected $prevObjectNumber = null;

    protected $prevCount = 0;

    public function __construct()
    {
        parent::__construct(new CrossReferenceStreamHeader());
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function __toString(): string
    {
        if (!$this->W || count($this->W) !== 3) {
            throw new \Exception('Invalid byte-widths');
        }
        if ($this->prevObjectNumber) {
            $count = count($this->objects);
            $this->header->Index[] = $count - $this->prevCount;
            $this->prevCount = $count;
            $this->prevObjectNumber = null;
        }

        $objects = $this->objects;

        $format = '';
        for ($i = 2; $i >= 0; --$i) {
            if ($this->W[$i] > 0) {
                $w = $this->W[$i] * 2;
                $format = "%0{$w}X" . $format;
            } else {
                foreach ($objects as &$object) {
                    unset($object[$i]);
                }
                unset($object);
            }
        }

        $this->data = [];
        foreach ($objects as $object) {
            $this->data[] = hex2bin(vsprintf($format, $object));
        }

        $this->data = join('', $this->data);

        return parent::__toString();
    }

    public function addFreeObject($objectNumber, $nextFreeObjectNumber, $generationNumber)
    {
        $this->addObject($objectNumber, 0, $nextFreeObjectNumber, $generationNumber);
    }

    public function addNotCompressedObject($objectNumber, $offset, $generationNumber = 0)
    {
        $this->addObject($objectNumber, 1, $offset, $generationNumber);
    }

    public function addCompressedObject($objectNumber, $streamObjectNumber, $index)
    {
        $this->addObject($objectNumber, 2, $streamObjectNumber, $index);
    }

    public function addObjectsFromStream(ObjectStream $stream)
    {
        // TODO: implement
    }

    public function addObject($objectNumber, $type, $f2, $f3)
    {
        if ($this->prevObjectNumber !== $objectNumber - 1) {
            $count = count($this->objects);
            if ($this->prevObjectNumber !== null) {
                $this->header->Index[] = $count - $this->prevCount;
            }
            $this->prevCount = $count;
            $this->header->Index[] = $objectNumber;
        }

        $this->objects[] = [$type, $f2, $f3];

        $this->prevObjectNumber = $objectNumber;
    }
}
