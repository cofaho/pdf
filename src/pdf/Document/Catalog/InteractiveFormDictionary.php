<?php

namespace pdf\Document\Catalog;


use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\Stream\StreamObject;
use pdf\ObjectType\StringObject;

/**
 * @property ArrayObject Fields
 * @property boolean NeedAppearances
 * @property integer SigFlags
 * @property ArrayObject CO calculation order
 * @property DictionaryObject DR default resources
 * @property StringObject DA default appearance
 * @property integer Q quadding (justification)
 * @property StreamObject|ArrayObject XFA (XML Forms Architecture)
 */
class InteractiveFormDictionary extends DictionaryObject
{

}
