<?php

namespace pdf\Document\Catalog;


use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\NameObject;

/**
 * @property-read NameObject Type
 * @property NameObject S
 * @property ArrayObject RH
 */
class RequirementDictionary extends DictionaryObject
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->Type = '/Requirement';
        // TODO: implement
    }
}
