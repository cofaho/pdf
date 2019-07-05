<?php

namespace pdf\Rendering;


use pdf\ObjectType\ByteStringObject;
use pdf\ObjectType\NameObject;
use pdf\ObjectType\Stream\StreamObjectHeader;

/**
 * @property-read NameObject Type
 * @property int HalftoneType
 * @property ByteStringObject HalftoneName
 */
class HalftoneHeader extends StreamObjectHeader
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->Type = '/Halftone';
    }
}
