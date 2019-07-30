<?php

namespace pdf\Document\Page;


use pdf\DataStructure\Rectangle;
use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\IndirectObject;
use pdf\ObjectType\NameObject;
use pdf\ObjectType\ObjectReference;

/**
 * @property-read NameObject Type
 * @property ObjectReference Parent
 * @property ArrayObject Kids
 * @property integer Count
 * @property DictionaryObject Resources
 * @property Rectangle MediaBox
 * @property Rectangle CropBox
 * @property integer Rotate
 */
class Pages extends DictionaryObject
{
    /**
     * @var Pages
     */
    protected $parent;

    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->Type = '/Pages';
        $this->Kids = new ArrayObject($config['Kids']);
        if (!isset($config['Count'])) {
            $this->Count = 0;
        }
    }

    /**
     * @param IndirectObject $page
     */
    public function addKid(IndirectObject $page)
    {
        $this->Kids[] = $page->getReference();
        if ($page->getObject() instanceof Pages) {
            $page->getObject()->parent = $this;
        } elseif ($page->getObject() instanceof Page) {
            $this->incCount();
        }
    }

    protected function incCount()
    {
        ++$this->Count;
        if ($this->parent) {
            $this->parent->incCount();
        }
    }
}
