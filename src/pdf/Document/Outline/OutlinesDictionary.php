<?php

namespace pdf\Document\Outline;


use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\NameObject;

/**
 * @property-read NameObject Type
 * @property DictionaryObject First
 * @property DictionaryObject Last
 * @property integer Count
 */
class OutlinesDictionary extends DictionaryObject
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->Type = '/Outlines';
        // TODO: implement
    }
}
