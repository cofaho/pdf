<?php

namespace pdf\Document;


use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\IndirectObject;

/**
 * @property DictionaryObject ExtGState
 * @property DictionaryObject ColorSpace
 * @property DictionaryObject Pattern
 * @property DictionaryObject Shading
 * @property DictionaryObject XObject
 * @property DictionaryObject Font
 * @property ArrayObject ProcSet
 * @property DictionaryObject Properties
 */
class ResourceDictionary extends DictionaryObject
{
    /**
     * @var int
     */
    protected $fontN = 0;

    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->Font = new DictionaryObject();
    }

    /**
     * @param IndirectObject $font
     * @return string Font ID
     */
    public function addFont(IndirectObject $font): string
    {
        $fontKey = 'F' . (++$this->fontN);
        $this->Font->$fontKey = $font->getReference();
        return $fontKey;
    }
}
