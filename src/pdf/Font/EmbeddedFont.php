<?php

namespace pdf\Font;


use pdf\ObjectType\Stream\StreamObject;

/**
 * @property EmbeddedFontHeader $header
 * @method EmbeddedFontHeader getHeader()
 */
class EmbeddedFont extends StreamObject
{
    public function __construct()
    {
        parent::__construct(new EmbeddedFontHeader());
    }
}
