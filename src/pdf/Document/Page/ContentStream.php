<?php

namespace pdf\Document\Page;


use pdf\ObjectType\Stream\StreamObject;
use pdf\ObjectType\Stream\StreamObjectHeader;

class ContentStream extends StreamObject
{
    protected $pageContents;

    public function __construct(StreamObjectHeader $header = null)
    {
        parent::__construct($header);
        $this->data = new PageContents();
    }

    public function getPageDescription(): PageDescriptionInterface
    {
        return $this->data;
    }
}
