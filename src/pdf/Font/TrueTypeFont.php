<?php

namespace pdf\Font;

use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\NameObject;
use pdf\ObjectType\ObjectReference;
use pdf\ObjectType\Stream\StreamObject;

/**
 * @property NameObject Name
 * @property NameObject BaseFont
 * @property integer FirstChar
 * @property integer LastChar
 * @property ObjectReference|ArrayObject Widths
 * @property ObjectReference|DictionaryObject FontDescriptor
 * @property ObjectReference|DictionaryObject|NameObject Encoding
 * @property ObjectReference|StreamObject ToUnicode
 */
class TrueTypeFont extends AbstractFont
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->Subtype = '/TrueType';
    }
}
