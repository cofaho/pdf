<?php

namespace pdf\Transparency;


use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\NameObject;
use pdf\ObjectType\Stream\StreamObject;

/**
 * @property-read NameObject Type
 * @property NameObject S
 * @property StreamObject G
 * @property ArrayObject BC
 * @property NameObject TR
 */
class SoftMask extends DictionaryObject
{
    const S_ALPHA = '/Alpha';

    const S_LUMINOSITY = '/Luminosity';

    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->Type = '/Mask';
    }
}
