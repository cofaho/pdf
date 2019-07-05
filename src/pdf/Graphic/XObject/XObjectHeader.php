<?php

namespace pdf\Graphic\XObject;


use pdf\ObjectType\NameObject;
use pdf\ObjectType\Stream\StreamObjectHeader;

/**
 * @property-read NameObject Type
 * @property NameObject Subtype
 */
class XObjectHeader extends StreamObjectHeader
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->Type = '/XObject';
    }
}
