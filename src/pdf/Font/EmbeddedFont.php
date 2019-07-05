<?php

namespace pdf\Font;


use pdf\ObjectType\Stream\StreamObject;

class EmbeddedFont extends StreamObject
{
    public function __construct()
    {
        parent::__construct(new EmbeddedFontHeader());
    }
}
