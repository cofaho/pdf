<?php

namespace pdf\ObjectType\Stream;


use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\NameObject;
use pdf\ObjectType\Stream\Filter\Filter;
use pdf\ObjectType\PdfObject;

/**
 * @property mixed data
 * @property integer Length
 * @property NameObject|ArrayObject Filter
 * @property DictionaryObject|ArrayObject DecodeParms
 * @property DictionaryObject|ArrayObject F
 * @property NameObject|ArrayObject FFilter
 * @property DictionaryObject|ArrayObject FDecodeParms
 * @property integer DL
 */
class StreamObject implements PdfObject
{
    /**
     * @var StreamObjectHeader
     */
    protected $header;
    /**
     * @var string
     */
    protected $data;

    /**
     * StreamObject constructor.
     * @param StreamObjectHeader $header
     */
    public function __construct(StreamObjectHeader $header = null)
    {
        $this->header = $header ?? new StreamObjectHeader();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $filters = $this->header->getFilters();
        if (!empty($filters)) {
            $this->header->DL = mb_strlen($this->data, '8bit');
        }
        if (is_array($this->data)) {
            $this->data = implode("\n", $this->data);
        }
        foreach ($filters as $filter) {
            $this->data = Filter::encode($filter['name'], $this->data, $filter['params']);
        }
        $this->header->Length = mb_strlen($this->data, '8bit');
        return $this->header . "\nstream\n" . $this->data ."\nendstream";
    }

    public function __get(string $name)
    {
        if ($name === 'data') {
            return $this->getData();
        }

        return $this->header->__get($name);
    }

    public function __set($name, $value)
    {
        if ($name === 'data') {
            $this->setData($value);
        } else {
            $this->header->__set($name, $value);
        }
    }

    public function __unset($name)
    {
        if ($name === 'data') {
            unset($this->data);
        } elseif (isset($this->header->$name)) {
            $this->header->__unset($name);
        }

    }

    /**
     * @param string $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param string $filterName
     * @return $this
     */
    public function addFilter(string $filterName)
    {
        $this->header->addFilter($filterName);
        return $this;
    }

}
