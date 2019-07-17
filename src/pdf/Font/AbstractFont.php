<?php

namespace pdf\Font;


use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\NameObject;

/**
 * @property-read string|NameObject Type
 * @property-read  NameObject Subtype
 */
abstract class AbstractFont extends DictionaryObject
{
    /**
     * Font constructor.
     * @param array|null $config
     */
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->Type = '/Font';
    }

}
