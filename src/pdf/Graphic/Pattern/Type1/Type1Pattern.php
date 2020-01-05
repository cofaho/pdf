<?php

namespace pdf\Graphic\Pattern\Type1;


use pdf\ObjectType\Stream\StreamObject;

/**
 * @property Type1PatternHeader $header
 * @method Type1PatternHeader getHeader()
 */
class Type1Pattern extends StreamObject
{
    public function __construct()
    {
        parent::__construct(new Type1PatternHeader());
    }
}
