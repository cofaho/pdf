<?php

namespace pdf\Document;


use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\ByteStringObject;
use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\PdfObject;

/**
 * @property integer Size
 * @property integer Prev
 * @property DictionaryObject Root
 * @property DictionaryObject Encrypt
 * @property DictionaryObject Info
 * @property ByteStringObject ID
 * @property integer xrefOffset
 * @property integer XRefStm
 */
class Trailer implements PdfObject
{
    /**
     * @var TrailerHeader
     */
    protected $header;

    /**
     * @var integer
     */
    protected $xrefOffset;

    /**
     * Trailer constructor.
     * @param null|array $config
     */
    public function __construct($config = null)
    {
        $this->header = new TrailerHeader($config);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return "trailer\n{$this->header}\nstartxref\n{$this->xrefOffset}\n%%EOF\n";
    }

    public function __get($name)
    {
        switch ($name) {
            case 'xrefOffset':
                return $this->getXrefOffset();
            case 'ID':
                return $this->header->ID[0] ?? null;
        }

        return $this->header->$name ?? null;
    }

    public function __set($name, $value)
    {
        switch ($name) {
            case 'xrefOffset':
                $this->setXrefOffset($value);
                break;
            case 'ID':
                if (!isset($this->header->ID)) {
                    $this->header->ID = new ArrayObject();
                }
                $id = new ByteStringObject($value);
                $this->header->ID[0] = $id;
                $this->header->ID[1] = $id;
                break;
            default:
                $this->header->$name = $value;
        }
    }

    public function __unset($name)
    {
        if ($name === 'xrefOffset') {
            unset($this->xrefOffset);
        } elseif (isset($this->header->$name)) {
            unset($this->header->$name);
        }
    }

    /**
     * @return int
     */
    public function getXrefOffset(): int
    {
        return $this->xrefOffset;
    }

    /**
     * @param int $xrefOffset
     * @return $this
     */
    public function setXrefOffset(int $xrefOffset): Trailer
    {
        $this->xrefOffset = $xrefOffset;
        return $this;
    }
}
