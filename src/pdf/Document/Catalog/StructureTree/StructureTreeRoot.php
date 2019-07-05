<?php

namespace pdf\Document\Catalog\StructureTree;


use lib\DataStructure\NumberTree;
use pdf\DataStructure\NameTree;
use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\NameObject;

/**
 * @property-read NameObject Type
 * @property DictionaryObject|ArrayObject K
 * @property NameTree IDTree
 * @property NumberTree ParentTree
 * @property integer ParentTreeNextKey
 * @property DictionaryObject RoleMap
 * @property DictionaryObject ClassMap
 */
class StructureTreeRoot extends DictionaryObject
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->Type = '/StructTreeRoot';
        // TODO: implement
    }
}
