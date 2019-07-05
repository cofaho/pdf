<?php

namespace pdf\Graphic\OptionalContent;


use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\NameObject;

/**
 * @property-read NameObject Type
 * @property DictionaryObject|ArrayObject OCGs
 * @property NameObject P visibility policy
 * @property ArrayObject VE visibility expression
 */
class OptionalContentMembershipHeader extends DictionaryObject // TODO: StreamObjectHeader?
{

}
