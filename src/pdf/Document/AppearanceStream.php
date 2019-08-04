<?php

namespace pdf\Document;


use pdf\ObjectType\Stream\StreamObject;

/**
 * @property AppearanceStreamHeader $header
 * @method AppearanceStreamHeader getHeader()
 */
class AppearanceStream extends StreamObject
{
    public function __construct()
    {
        parent::__construct(new AppearanceStreamHeader());
    }
    // TODO: implement
}
