<?php

namespace pdf\Document\Thread;


use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\NameObject;

/**
 * @property-read NameObject Type
 * @property DictionaryObject F
 * @property DictionaryObject I
 */
class ThreadDictionary extends DictionaryObject
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->Type = '/Thread';
        // TODO: implement
    }
}
