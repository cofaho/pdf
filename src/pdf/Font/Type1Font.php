<?php

namespace pdf\Font;


use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\NameObject;
use pdf\ObjectType\ObjectReference;
use pdf\ObjectType\Stream\StreamObject;

/**
 * @property NameObject BaseFont
 * @property integer FirstChar
 * @property integer LastChar
 * @property ObjectReference|ArrayObject Widths
 * @property ObjectReference FontDescriptor
 * @property DictionaryObject|NameObject Encoding
 * @property StreamObject ToUnicode
 */
class Type1Font extends AbstractFont
{
    /**
     * Type1 constructor.
     * @param array|null $config
     */
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->Subtype = '/Type1';
    }

}
