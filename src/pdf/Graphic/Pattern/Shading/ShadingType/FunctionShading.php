<?php

namespace pdf\Graphic\Pattern\Shading\ShadingType;


use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\ObjectReference;

/**
 * @property ArrayObject Domain
 * @property ArrayObject Matrix
 * @property ObjectReference Function
 */
class FunctionShading extends ShadingDictionary
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->ShadingType = ShadingType::FUNCTION;
    }
}
