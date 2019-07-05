<?php

namespace pdf\Graphic\Pattern\Shading\ShadingType;


use pdf\DataStructure\Rectangle;
use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\NameObject;

/**
 * @property int ShadingType
 * @property NameObject|ArrayObject ColorSpace
 * @property ArrayObject Background
 * @property Rectangle BBox
 * @property bool AntiAlias
 */
class ShadingDictionary extends DictionaryObject
{

}
