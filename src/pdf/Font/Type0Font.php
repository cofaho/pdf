<?php

namespace pdf\Font;


use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\NameObject;
use pdf\ObjectType\ObjectReference;
use pdf\ObjectType\Stream\StreamObject;

/**
 * @property NameObject BaseFont
 * @property ObjectReference|DictionaryObject|NameObject Encoding
 * @property ArrayObject DescendantFonts
 * @property ObjectReference|StreamObject ToUnicode
 */
class Type0Font extends AbstractFont
{

}
