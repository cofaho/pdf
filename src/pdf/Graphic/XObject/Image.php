<?php

namespace pdf\Graphic\XObject;


use pdf\ObjectType\Stream\StreamObject;

/**
 * @property ImageHeader $header
 * @method ImageHeader getHeader()
 */
class Image extends StreamObject
{
    public function __construct()
    {
        parent::__construct(new ImageHeader());
    }

    public function __toString(): string
    {
        $name = null;
        if ($this->getHeader()->Name) {
            $name = $this->getHeader()->Name;
            unset($this->getHeader()->Name);
        }
        $result = parent::__toString();
        if ($name) {
            $this->getHeader()->Name = $name;
        }

        return $result;
    }
}
