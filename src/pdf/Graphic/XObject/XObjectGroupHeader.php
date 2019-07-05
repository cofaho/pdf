<?php

namespace pdf\Graphic\XObject;


use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\NameObject;

/**
 * @property-read NameObject Type
 * @property NameObject S subtype
 */
class XObjectGroupHeader extends DictionaryObject //TODO: check, maybe extends StreamObjectHeader or XObjectHeader
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->Type = '/Group';
        $this->S = '/Transparency';
    }
}
