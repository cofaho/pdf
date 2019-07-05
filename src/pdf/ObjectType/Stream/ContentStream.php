<?php

namespace pdf\ObjectType\Stream;


class ContentStream extends StreamObject
{
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
