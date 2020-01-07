<?php

namespace pdf\Graphic\XObject;


use pdf\ObjectType\Stream\StreamObject;

/**
 * @property ImageHeader $header
 * @method ImageHeader getHeader()
 */
class Image extends StreamObject
{
    public function __construct()
    {
        parent::__construct(new ImageHeader());
    }
}
