<?php

namespace lib\ObjectType\Stream;


use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\NameObject;
use pdf\ObjectType\Stream\StreamObjectHeader;

/**
 * @property-read NameObject Type
 * @property NameObject Subtype
 * @property DictionaryObject Params
 */
class FileStreamHeader extends StreamObjectHeader
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->Type = '/EmbeddedFile';
    }
}
