<?php

namespace pdf\ObjectType;


class ByteStringObject implements PdfObject
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
        return '<' . bin2hex($this->string) . '>';
    }

    /**
     * @param string $string
     * @return $this
     */
    public function setString(string $string): ByteStringObject
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
