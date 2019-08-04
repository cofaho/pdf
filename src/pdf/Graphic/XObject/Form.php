<?php

namespace pdf\Graphic\XObject;


use pdf\ObjectType\Stream\StreamObject;

/**
 * @property FormHeader $header
 * @method FormHeader getHeader()
 */
class Form extends StreamObject
{
    public function __construct()
    {
        parent::__construct(new FormHeader());
    }
}
