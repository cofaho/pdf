<?php

namespace pdf\Document;

use pdf\ObjectType\ByteStringObject;
use pdf\ObjectType\DictionaryObject;

/**
 * @property integer Size
 * @property integer Prev
 * @property DictionaryObject Root
 * @property DictionaryObject Encrypt
 * @property DictionaryObject Info
 * @property ByteStringObject ID
 * @property integer XRefStm
 */
class TrailerHeader extends DictionaryObject
{

}
