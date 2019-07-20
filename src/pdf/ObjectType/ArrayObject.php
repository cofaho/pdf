<?php

namespace pdf\ObjectType;


use ArrayAccess;
use Countable;
use Iterator;
use pdf\Helper\Math;

class ArrayObject implements PdfObject, ArrayAccess, Iterator, Countable
{
    /**
     * @var array
     */
    protected $items = [];

    protected $position = 0;

    /**
     * @param null|array $config
     */
    public function __construct($config = null)
    {
        if ($config && is_array($config)) {
            foreach ($config as $k => $v) {
                $this->offsetSet($k, $v);
            }
        }
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return '[' . implode(' ', $this->items) . ']';
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->items;
    }

    /**
     * ArrayAccess interface
     * @param $key
     * @return bool
     */
    public function offsetExists($key): bool
    {
        return isset($this->items[$key]);
    }

    /**
     * @param mixed $key
     * @return mixed|null
     */
    public function offsetGet($key)
    {
        return $this->items[$key] ?? null;
    }

    /**
     * @param mixed $key
     * @param mixed $value
     */
    public function offsetSet($key, $value): void
    {
        if ($value === null) {
            $value = 'null';
        } elseif (is_bool($value)) {
            $value = $value ? 'true' : 'false';
        } elseif (is_float($value)) {
            $value = Math::floatToStr($value);
        }

        if ($key === null) {
            $this->items[] = $value;
        } else {
            $this->items[$key] = $value;
        }
    }

    /**
     * @param mixed $key
     */
    public function offsetUnset($key): void
    {
        unset($this->items[$key]);
    }

    /**
     * Countable interface
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * Iterator interface
     */
    public function current()
    {
        return $this->items[$this->position];
    }

    public function next()
    {
        ++$this->position;
    }

    public function key()
    {
        return $this->position;
    }

    public function valid()
    {
        return isset($this->items[$this->position]);
    }

    public function rewind()
    {
        $this->position = 0;
    }
}
