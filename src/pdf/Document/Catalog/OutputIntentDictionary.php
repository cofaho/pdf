<?php

namespace pdf\Document\Catalog;


use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\NameObject;
use pdf\ObjectType\Stream\StreamObject;
use pdf\ObjectType\StringObject;

/**
 * @property-read NameObject Type
 * @property NameObject S subtype
 * @property StringObject OutputCondition
 * @property StringObject OutputConditionIdentifier
 * @property StringObject RegistryName
 * @property StringObject Info
 * @property StreamObject DestOutputProfile
 */
class OutputIntentDictionary extends DictionaryObject
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->Type = '/OutputIntent';
        // TODO: implement
    }
}
