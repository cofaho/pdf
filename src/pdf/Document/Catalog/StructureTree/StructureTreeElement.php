<?php

namespace pdf\Document\Catalog\StructureTree;


use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\ByteStringObject;
use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\NameObject;
use pdf\ObjectType\ObjectReference;
use pdf\ObjectType\StringObject;

/**
 * @property-read NameObject Type
 * @property NameObject S structure type
 * @property ObjectReference P parent
 * @property ByteStringObject ID
 * @property ObjectReference Pg page
 * @property mixed K
 * @property mixed A attribute
 * @property NameObject|ArrayObject C classes
 * @property integer R revision number
 * @property StringObject T title
 * @property StringObject Lang
 * @property StringObject Alt alternate description
 * @property StringObject E expanded form of an abbreviation
 * @property StringObject ActualText
 */
class StructureTreeElement extends DictionaryObject
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->Type = '/StructElem';
        // TODO: implement
    }
}
