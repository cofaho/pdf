<?php

namespace pdf\Document\Thread;


use pdf\DataStructure\Rectangle;
use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\NameObject;

/**
 * @property-read NameObject Type
 * @property DictionaryObject T
 * @property DictionaryObject N
 * @property DictionaryObject V
 * @property DictionaryObject P
 * @property Rectangle R
 */
class BeadDictionary extends DictionaryObject
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->Type = '/Bead';
        // TODO: implement
    }
}
