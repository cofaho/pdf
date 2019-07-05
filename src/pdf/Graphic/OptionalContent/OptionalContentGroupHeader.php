<?php

namespace pdf\Graphic\OptionalContent;


use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\NameObject;

/**
 * @property-read NameObject Type
 * @property string Name
 * @property NameObject|ArrayObject Intent
 * @property DictionaryObject Usage
 */
class OptionalContentGroupHeader extends DictionaryObject // TODO: StreamObjectHeader?
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->Type = 'OCG';
    }
}
