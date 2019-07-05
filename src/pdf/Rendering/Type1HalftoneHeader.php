<?php

namespace pdf\Rendering;


use pdf\ObjectType\NameObject;

/**
 * @property float Frequency
 * @property float Angle
 * @property NameObject SpotFunction
 * @property bool AccurateScreens
 * @property NameObject TransferFunction
 */
class Type1HalftoneHeader extends HalftoneHeader
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->HalftoneType = 1;
    }
}
