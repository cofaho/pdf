<?php

namespace pdf\Rendering;


use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\Stream\StreamObject;

/**
 * @property DictionaryObject|StreamObject Default
 */
class Type5HalftoneHeader extends HalftoneHeader
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->HalftoneType = 5;
    }
}
