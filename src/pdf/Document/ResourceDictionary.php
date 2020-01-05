<?php

namespace pdf\Document;


use pdf\Graphic\GraphicsState;
use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\IndirectObject;

/**
 * @property GraphicsState ExtGState
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
    protected $dictionaries = ['ExtGState' => 0, 'ColorSpace' => 0, 'Pattern' => 0, 'Shading' => 0, 'XObject' => 0, 'Font' => 0, 'Properties' => 0];

    public function addIndirectObject(IndirectObject $indirectObject)
    {
        $object = $indirectObject->getObject();
        $type = trim($object->Type, '/');

        if (!isset($this->dictionaries[$type])) {
            throw new \InvalidArgumentException("Can't add object of type `$type` to ResourceDictionary");
        }

        $name = $type . ++$this->dictionaries[$type];
        $this->$type->$name = $indirectObject->getReference();

        return $this;
    }

    public function __get($name)
    {
        if (!isset($this->items[$name])) {
            if (isset($this->dictionaries[$name])) {
                $this->items[$name] = new DictionaryObject();
            } elseif ($name === 'ProcSet') {
                $this->items[$name] = new ArrayObject();
            }
        }
        return parent::__get($name);
    }


}
