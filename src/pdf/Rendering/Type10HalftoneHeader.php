<?php

namespace pdf\Rendering;


use pdf\ObjectType\NameObject;

/**
 * @property int Xsquare
 * @property int Ysquare
 * @property NameObject TransferFunction
 */
class Type10HalftoneHeader extends HalftoneHeader
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->HalftoneType = 10;
    }
}
