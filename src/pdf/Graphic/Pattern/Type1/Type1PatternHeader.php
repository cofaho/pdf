<?php

namespace lib\Pattern\Type1;


use pdf\DataStructure\Rectangle;
use pdf\Graphic\Pattern\Pattern;
use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\NameObject;
use pdf\ObjectType\Stream\StreamObjectHeader;

/**
 * @property-read NameObject Type
 * @property integer PatternType
 * @property integer PaintType
 * @property integer TilingType
 * @property Rectangle BBox
 * @property float XStep
 * @property float YStep
 * @property DictionaryObject Resources
 * @property ArrayObject Matrix
 */
class Type1PatternHeader extends StreamObjectHeader
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->Type = '/Pattern';
        $this->PatternType = Pattern::TYPE_TILING;
    }
}
