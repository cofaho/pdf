<?php

namespace pdf\Font;


use pdf\DataStructure\Rectangle;
use pdf\ObjectType\ByteStringObject;
use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\NameObject;
use pdf\ObjectType\Stream\StreamObject;

/**
 * @property-read NameObject Type
 * @property NameObject FontName
 * @property ByteStringObject FontFamily
 * @property NameObject FontStretch
 * @property int FontWeight
 * @property int Flags
 * @property Rectangle FontBBox
 * @property float ItalicAngle
 * @property float Ascent
 * @property float Descent
 * @property float Leading
 * @property float CapHeight
 * @property float XHeight
 * @property float StemV
 * @property float StemH
 * @property float AvgWidth
 * @property float MaxWidth
 * @property float MissingWidth
 * @property StreamObject FontFile for Type 1
 * @property StreamObject FontFile2 for TrueType
 * @property StreamObject FontFile3 for Type1C and CIDFontType0C
 * @property string|ByteStringObject CharSet
 */
class FontDescriptor extends DictionaryObject
{
    const FLAG_FIXED_PITCH = 1;
    const FLAG_SERIF = 2;
    const FLAG_SYMBOLIC = 4;
    const FLAG_SCRIPT = 8;
    const FLAG_NONSYMBOLIC = 32;
    const FLAG_ITALIC = 64;
    const FLAG_ALL_CAP = 65536;
    const FLAG_SMALL_CAP = 131072;
    const FLAG_FORCE_BOLD = 262144;

    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->Type = '/FontDescriptor';
        // TODO: implement
    }
}
