<?php

namespace pdf\Document;


use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\NameObject;
use pdf\ObjectType\Stream\StreamObjectHeader;

/**
 * @property-read NameObject Type
 * @property integer Size
 * @property ArrayObject Index
 * @property integer Prev
 * @property ArrayObject W
 */
class CrossReferenceStreamHeader extends StreamObjectHeader
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->Type = '/XRef';
        $this->Index = new ArrayObject();
    }
}
