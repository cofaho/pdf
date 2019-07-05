<?php

namespace pdf\Font;


use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\NameObject;


/**
 * @property-read NameObject Type
 * @property NameObject BaseEncoding
 * @property ArrayObject Differences
 */
class Encoding extends DictionaryObject
{
    const STANDARD_ENCODING = '/StandardEncoding';

    const MAC_ROMAN_ENCODING = '/MacRomanEncoding';

    const WIN_ANSI_ENCODING = '/WinAnsiEncoding';

    const PDF_DOC_ENCODING = '/PDFDocEncoding';

    const MAC_EXPERT_ENCODING = '/MacExpertEncoding';

    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->Type = '/Encoding';
    }
}
