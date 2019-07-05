<?php

namespace pdf\Document\Catalog;


use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\NameObject;

/**
 * @property-read NameObject Type
 * @property NameObject BaseVersion
 * @property integer ExtensionLevel
 */
class DeveloperExtensionsDictionary extends DictionaryObject
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->Type = 'DeveloperExtensions';
        // TODO: implement
    }
}
