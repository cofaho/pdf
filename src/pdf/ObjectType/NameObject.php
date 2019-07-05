<?php

namespace pdf\ObjectType;


use Exception;

class NameObject implements PdfObject
{
    /**
     * @var string
     */
    protected $name;

    protected static $delimiters = [
        '(' => 1, ')' => 1,
        '<' => 1, '>' => 1,
        '[' => 1, ']' => 1,
        '{' => 1, '}' => 1,
        '/' => 1,
        '%' => 1,
        '#' => 1,
        '\\' => 1
    ];

    /**
     * NameObject constructor.
     * @param string $name
     * @throws Exception
     */
    public function __construct(string $name)
    {
        $this->setName($name);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return '/' . self::escape($this->name);
    }

    /**
     * @param string $name
     * @return $this
     * @throws Exception
     */
    public function setName(string $name): NameObject
    {
        if (empty($name)) {
            throw new Exception('Empty name');
        }
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEscapedName(): string
    {
        return self::escape($this->name);
    }

    /**
     * @param string $name
     * @return string
     */
    public static function escape(string $name): string
    {
        $result = '';

        for ($i = 0; $i < strlen($name); $i++) {
            $char = $name[$i];
            $charCode = ord($char);

            if ($charCode < 33 || $charCode > 126 || isset(self::$delimiters[$char])) {
                $result .= sprintf('#%02X', $charCode);
            } else {
                $result .= $char;
            }
        }

        return $result;
    }

}
