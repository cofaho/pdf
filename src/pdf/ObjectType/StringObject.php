<?php

namespace pdf\ObjectType;


class StringObject implements PdfObject
{
    /**
     * @var string
     */
    protected $string;

    /**
     * StringObject constructor.
     * @param string $string
     */
    public function __construct(string $string = '')
    {
        $this->setString($string);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return '(' . addcslashes($this->string, "\n\r\t\x08\f()\\") . ')';
    }

    /**
     * @param string $string
     * @return $this
     */
    public function setString(string $string): StringObject
    {
        $this->string = $string;
        return $this;
    }

    /**
     * @return string
     */
    public function getString(): string
    {
        return $this->string;
    }
}
