<?php

namespace pdf\Graphic\Pattern\Shading;


use pdf\ObjectType\Stream\StreamObject;

/**
 * @property ShadingPatternHeader $header
 * @method ShadingPatternHeader getHeader()
 */
class ShadingPattern extends StreamObject
{
    public function __construct()
    {
        parent::__construct(new ShadingPatternHeader());
    }
}
