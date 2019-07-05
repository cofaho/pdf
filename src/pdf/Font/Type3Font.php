<?php

namespace pdf\Font;


use pdf\DataStructure\Rectangle;
use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\NameObject;
use pdf\ObjectType\ObjectReference;
use pdf\ObjectType\Stream\StreamObject;

/**
 * @property NameObject Name
 * @property Rectangle FontBBox
 * @property ArrayObject FontMatrix
 * @property DictionaryObject CharProcs
 * @property NameObject | DictionaryObject Encoding
 * @property integer FirstChar
 * @property integer LastChar
 * @property ObjectReference|ArrayObject Widths
 * @property ObjectReference|DictionaryObject FontDescriptor
 * @property DictionaryObject Resources
 * @property StreamObject ToUnicode
 */
class Type3Font extends AbstractFont
{

}
