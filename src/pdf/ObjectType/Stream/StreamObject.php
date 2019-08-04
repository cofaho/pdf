<?php

namespace pdf\ObjectType\Stream;


use pdf\ObjectType\Stream\Filter\Filter;
use pdf\ObjectType\PdfObject;

class StreamObject implements PdfObject
{
    /**
     * @var StreamObjectHeader
     */
    protected $header;
    /**
     * @var mixed
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
        $data = is_array($this->data) ? implode("\n", $this->data) : (string)$this->data;

        if (!empty($filters)) {
            $this->header->DL = mb_strlen($data, '8bit');
        }
        foreach ($filters as $filter) {
            $data = Filter::encode($filter['name'], $data, $filter['params']);
        }
        $this->header->Length = mb_strlen($data, '8bit');

        return $this->header . "\nstream\n" . $data ."\nendstream";
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
     * @return StreamObjectHeader
     */
    public function getHeader()
    {
        return $this->header;
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
