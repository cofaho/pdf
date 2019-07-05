<?php

namespace pdf\Graphic\XObject;

use pdf\DataStructure\DateObject;
use pdf\DataStructure\Rectangle;
use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\NameObject;
use pdf\ObjectType\Stream\StreamObject;

/**
 * @property int FormType
 * @property Rectangle BBox
 * @property ArrayObject Matrix
 * @property DictionaryObject Resources
 * @property DictionaryObject Group
 * @property DictionaryObject Ref
 * @property StreamObject Metadata
 * @property DictionaryObject PieceInfo
 * @property DateObject LastModified
 * @property int StructParent
 * @property int StructParents
 * @property DictionaryObject OPI Open Prepress Interface
 * @property DictionaryObject OC optional content
 * @property NameObject Name
 */
class FormHeader extends XObjectHeader
{

}
