<?php

namespace pdf\Document\Page;


use pdf\DataStructure\DateObject;
use pdf\DataStructure\Rectangle;
use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\ByteStringObject;
use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\NameObject;
use pdf\ObjectType\ObjectReference;
use pdf\ObjectType\Stream\StreamObject;

/**
 * @property-read NameObject Type
 * @property ObjectReference Parent
 * @property DateObject LastModified
 * @property DictionaryObject Resources
 * @property Rectangle MediaBox
 * @property Rectangle CropBox
 * @property Rectangle BleedBox
 * @property Rectangle TrimBox
 * @property Rectangle ArtBox
 * @property DictionaryObject BoxColorInfo
 * @property ContentStream|ArrayObject Contents
 * @property integer Rotate
 * @property DictionaryObject Group
 * @property StreamObject Thumb
 * @property ArrayObject B
 * @property integer Dur
 * @property DictionaryObject Trans
 * @property ArrayObject Annots
 * @property DictionaryObject AA
 * @property StreamObject Metadata
 * @property DictionaryObject PieceInfo
 * @property integer StructParents
 * @property ByteStringObject|ObjectReference ID
 * @property float PZ
 * @property DictionaryObject SeparationInfo
 * @property NameObject Tabs
 * @property NameObject TemplateInstantiated
 * @property DictionaryObject PresSteps
 * @property float UserUnit
 * @property DictionaryObject VP
 */
class Page extends DictionaryObject
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->Type = '/Page';
        $this->Resources = new DictionaryObject($config['Resources']);
        $this->Contents = new ArrayObject($config['Contents']);
    }
}
