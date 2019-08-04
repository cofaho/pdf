<?php

namespace pdf\Graphic\XObject;


use pdf\ObjectType\Stream\StreamObject;

/**
 * @property PostScriptHeader $header
 * @method PostScriptHeader getHeader()
 */
class PostScript extends StreamObject
{
    public function __construct()
    {
        parent::__construct(new PostScriptHeader());
    }
}
