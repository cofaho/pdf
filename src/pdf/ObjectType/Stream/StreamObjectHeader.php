<?php

namespace pdf\ObjectType\Stream;


use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\NameObject;

/**
 * @property integer Length
 * @property NameObject|ArrayObject Filter
 * @property DictionaryObject|ArrayObject DecodeParms
 * @property DictionaryObject|ArrayObject F
 * @property NameObject|ArrayObject FFilter
 * @property DictionaryObject|ArrayObject FDecodeParms
 * @property integer DL
 */
class StreamObjectHeader extends DictionaryObject
{
    /**
     * @param NameObject|string $filterName
     * @return StreamObjectHeader
     */
    public function addFilter($filterName)
    {
        $filterName = $filterName instanceof NameObject ? (string)$filterName : NameObject::escape($filterName);

        if (!isset($this->Filter)) {
            $this->Filter = new ArrayObject();
        }

        $this->Filter[] = '/' . $filterName;

        return $this;
    }

    public function getFilters()
    {
        $result = [];

        $filter = 'Filter';
        $params = 'DecodeParms';

        if (isset($this->F)) {
            $filter = 'F' . $filter;
            $params = 'F' . $params;
        }

        if (!isset($this->$filter)) {
            return [];
        }

        if ($this->$filter instanceof ArrayObject) {
            foreach ($this->$filter as $f) {
                $name = $f instanceof NameObject ? $f->getName() : ltrim($f, '/');
                $result[] = ['name' => $name, 'params' => $this->$params];
            }
        } else {
            $name = $this->$filter instanceof NameObject ? $this->$filter->getName() : ltrim($this->$filter, '/');
            $result[] = ['name' => $name, 'params' => $this->$params];
        }

        return array_reverse($result);
    }
}
