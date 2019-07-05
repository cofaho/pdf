<?php

namespace lib\ObjectType\Stream;


use pdf\DataStructure\DateObject;
use pdf\ObjectType\DictionaryObject;

/**
 * @property integer Size
 * @property DateObject CreationDate
 * @property DateObject ModDate
 * @property DictionaryObject Mac
 * @property string CheckSum
 */
class FileStreamParameterDictionary extends DictionaryObject
{

}
