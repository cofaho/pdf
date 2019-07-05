<?php

namespace pdf\Font;

use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\NameObject;
use pdf\ObjectType\Stream\StreamObject;

/**
 * @property NameObject BaseFont
 * @property CIDSystemInfo CIDSystemInfo
 * @property FontDescriptor FontDescriptor
 * @property int DW default width for glyphs
 * @property ArrayObject W glyphs widths
 * @property ArrayObject DW2 default width for vertical writing
 * @property ArrayObject W2 glyphs widths for vertical writing
 * @property StreamObject|NameObject CIDToGIDMap
 */
class CIDFont extends AbstractFont
{
    // Subtype values
    const TYPE_0 = '/CIDFontType0';
    const TYPE_2 = '/CIDFontType2';
}
