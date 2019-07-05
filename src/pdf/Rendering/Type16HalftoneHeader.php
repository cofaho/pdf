<?php

namespace pdf\Rendering;


use pdf\ObjectType\NameObject;

/**
 * @property int Width
 * @property int Height
 * @property int Width2
 * @property int Height2
 * @property NameObject TransferFunction
 */
class Type16HalftoneHeader extends HalftoneHeader
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->HalftoneType = 16;
    }
}
