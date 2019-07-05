<?php

namespace pdf\Graphic\XObject;


use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\ObjectReference;
use pdf\ObjectType\Stream\StreamObject;

/**
 * @property ObjectReference|StreamObject Image
 * @property bool DefaultForPrinting
 * @property DictionaryObject OC
 */
class AlternateImageDictionary extends DictionaryObject
{

}
