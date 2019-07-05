<?php

namespace pdf\Document\Catalog;


use pdf\ObjectType\ByteStringObject;
use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\NameObject;

/**
 * @property-read  NameObject Type
 * @property DictionaryObject Schema
 * @property ByteStringObject D
 * @property NameObject View
 * @property DictionaryObject Sort
 */
class CollectionDictionary extends DictionaryObject
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->Type = '/Collection';
        // TODO: implement
    }
}
