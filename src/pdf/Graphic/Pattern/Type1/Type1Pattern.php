<?php

namespace lib\Pattern\Type1;


use pdf\ObjectType\Stream\StreamObject;

class Type1Pattern extends StreamObject
{
    public function __construct()
    {
        parent::__construct(new Type1PatternHeader());
    }
}
