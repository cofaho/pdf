<?php

namespace pdf\Graphic\Pattern\Shading\ShadingType;


use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\ObjectReference;

/**
 * @property int BitsPerCoordinate
 * @property int BitsPerComponent
 * @property int BitsPerFlag
 * @property ArrayObject Decode
 * @property ObjectReference Function
 */
class FreeTriangleShading extends ShadingDictionary
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->ShadingType = ShadingType::FREE_FORM_TRIANGLE;
    }
}
