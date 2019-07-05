<?php

namespace pdf\Graphic\Pattern\Shading\ShadingType;


use pdf\ObjectType\ArrayObject;

/**
 * @property ArrayObject Coords
 * @property ArrayObject Domain
 * @property string Function
 * @property ArrayObject Extend
 */
class RadialShading extends ShadingDictionary
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->ShadingType = ShadingType::RADIAL;
    }
}
