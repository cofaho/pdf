<?php

namespace pdf\Document\Page;


use pdf\DataStructure\Rectangle;
use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\NameObject;
use pdf\ObjectType\ObjectReference;

/**
 * @property-read NameObject Type
 * @property ObjectReference Parent
 * @property ArrayObject Kids
 * @property integer Count
 * @property DictionaryObject Resources
 * @property Rectangle MediaBox
 * @property Rectangle CropBox
 * @property integer Rotate
 */
class Pages extends DictionaryObject
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->Type = '/Pages';
        $this->Kids = new ArrayObject($config['Kids']);
        if (!isset($config['Count'])) {
            $this->Count = 0;
        }
    }
}
