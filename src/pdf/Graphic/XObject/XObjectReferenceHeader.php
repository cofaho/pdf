<?php

namespace pdf\Graphic\XObject;


use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\DictionaryObject;

/**
 * @property string F file
 * @property string|int Page
 * @property ArrayObject ID
 */
class XObjectReferenceHeader extends DictionaryObject //TODO: check, maybe extends StreamObjectHeader or XObjectHeader
{

}
