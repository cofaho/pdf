<?php

namespace pdf\ObjectType;


class DictionaryObject implements PdfObject
{
    /**
     * @var array
     */
    protected $items = [];

    /**
     * @param null|array $config
     */
    public function __construct(?array $config = null)
    {
        if ($config && is_array($config)) {
            foreach ($config as $name => $value) {
                $this->$name = $value;
            }
        }
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $pairs = [];
        if ($this->items) {
            foreach ($this->items as $name => $value) {
                $pairs[] = '/' . $name . ' ' . $value;
            }
        }
        return '<<' . implode(' ', $pairs) . '>>';
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value): void
    {
        $this->setValue($name, $value);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->items[$name] ?? null;
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->items[$name]);
    }

    /**
     * @param string $name
     */
    public function __unset($name): void
    {
        unset($this->items[$name]);
    }


    /**
     * @param string|NameObject $name Should be NameObject or escaped string
     * @param Object $value
     * @return $this
     */
    public function setValue($name, $value)
    {
        if ($name instanceof NameObject) {
            $name = $name->getEscapedName();
        }

        if ($value === null) {
            $value = 'null';
        } elseif (is_bool($value)) {
            $value = $value ? 'true' : 'false';
        }

        $this->items[$name] = $value;

        return $this;
    }

}
