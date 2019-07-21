<?php

namespace pdf\Document\Page;


use pdf\Graphic\Operator\Color;
use pdf\Graphic\Operator\ExternalObject;
use pdf\Graphic\Operator\GeneralGraphicsState;
use pdf\Graphic\Operator\MarkedContent;
use pdf\Graphic\Operator\ShadingObject;
use pdf\Graphic\Operator\SpecialGraphicsState;
use pdf\Graphic\Path;
use pdf\Graphic\Text;
use pdf\ObjectType\Stream\StreamObject;
use pdf\ObjectType\Stream\StreamObjectHeader;

class ContentStream extends StreamObject implements ContentStreamInterface
{
    use Path, Text, Color,
        GeneralGraphicsState, SpecialGraphicsState,
        ExternalObject, ShadingObject, MarkedContent;

    public function __construct(StreamObjectHeader $header = null)
    {
        parent::__construct($header);
        $this->data = [];
    }

    public function append($data)
    {
        $this->data[] = $data;
    }
}
