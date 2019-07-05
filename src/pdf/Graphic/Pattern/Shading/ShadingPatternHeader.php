<?php

namespace pdf\Graphic\Pattern\Shading;


use pdf\Graphic\Pattern\Pattern;
use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\NameObject;
use pdf\ObjectType\Stream\StreamObject;
use pdf\ObjectType\Stream\StreamObjectHeader;

/**
 * @property-read NameObject Type
 * @property int PatternType
 * @property DictionaryObject|StreamObject Shading
 * @property ArrayObject Matrix
 * @property DictionaryObject ExtGState
 */
class ShadingPatternHeader extends StreamObjectHeader
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->Type = '/Pattern';
        $this->PatternType = Pattern::TYPE_SHADING;
    }

}
