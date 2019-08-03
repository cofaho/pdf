<?php

namespace pdf\Graphic\XObject;

use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\ByteStringObject;
use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\NameObject;
use pdf\ObjectType\Stream\StreamObject;

/**
 * @property int Width
 * @property int Height
 * @property NameObject|ArrayObject ColorSpace
 * @property int BitsPerComponent
 * @property NameObject Intent
 * @property bool ImageMask
 * @property StreamObject|ArrayObject Mask
 * @property ArrayObject Decode
 * @property bool Interpolate
 * @property ArrayObject Alternates
 * @property StreamObject SMask
 * @property int SMaskInData
 * @property NameObject Name
 * @property int StructParent
 * @property ByteStringObject ID
 * @property DictionaryObject OPI
 * @property StreamObject Metadata
 * @property DictionaryObject OC
 */
class ImageHeader extends XObjectHeader
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->Subtype = '/Image';
    }
}
