<?php

namespace pdf\Graphic\Pattern\Shading\ShadingType;


use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\ObjectReference;

/**
 * @property ArrayObject Coords
 * @property ArrayObject Domain
 * @property ObjectReference Function
 * @property ArrayObject Extend
 */
class AxialShading extends ShadingDictionary
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->ShadingType = ShadingType::AXIAL;
    }
}
