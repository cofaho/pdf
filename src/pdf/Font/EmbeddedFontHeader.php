<?php

namespace pdf\Font;


use pdf\ObjectType\NameObject;
use pdf\ObjectType\Stream\StreamObject;
use pdf\ObjectType\Stream\StreamObjectHeader;

/**
 * @property int Length1
 * @property int Length2
 * @property int Length3
 * @property NameObject Subtype
 * @property StreamObject Metadata
 */
class EmbeddedFontHeader extends StreamObjectHeader
{

}
