<?php

namespace pdf\Document\Outline;


use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\ByteStringObject;
use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\NameObject;
use pdf\ObjectType\StringObject;

/**
 * @property StringObject Title
 * @property DictionaryObject Parent
 * @property DictionaryObject Prev
 * @property DictionaryObject Next
 * @property DictionaryObject First
 * @property DictionaryObject Last
 * @property integer Count
 * @property NameObject|ByteStringObject|ArrayObject Dest
 * @property DictionaryObject A
 */
class OutlineItemDictionary extends DictionaryObject
{
    // TODO: implement
}
