<?php

namespace pdf\Rendering;


use pdf\ObjectType\NameObject;

/**
 * @property int Width
 * @property int Height
 * @property NameObject TransferFunction
 */
class Type6HalftoneHeader extends HalftoneHeader
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->HalftoneType = 6;
    }
}
