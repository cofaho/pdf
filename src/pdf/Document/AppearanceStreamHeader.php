<?php

namespace pdf\Document;


use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\Stream\StreamObject;
use pdf\ObjectType\Stream\StreamObjectHeader;

/**
 * @property StreamObject|DictionaryObject N
 * @property StreamObject|DictionaryObject R
 * @property StreamObject|DictionaryObject D
 */
class AppearanceStreamHeader extends StreamObjectHeader
{

}
