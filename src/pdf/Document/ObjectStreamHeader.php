<?php

namespace pdf\Document;


use pdf\ObjectType\NameObject;
use pdf\ObjectType\ObjectReference;
use pdf\ObjectType\Stream\StreamObject;
use pdf\ObjectType\Stream\StreamObjectHeader;

/**
 * @property-read NameObject Type
 * @property integer N
 * @property integer First
 * @property ObjectReference|StreamObject Extends
 */
class ObjectStreamHeader extends StreamObjectHeader
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->Type = '/ObjStm';
    }
}
