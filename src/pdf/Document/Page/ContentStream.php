<?php

namespace pdf\Document\Page;


use pdf\ObjectType\Stream\StreamObject;
use pdf\ObjectType\Stream\StreamObjectHeader;

class ContentStream extends StreamObject
{
    public function __construct(StreamObjectHeader $header = null)
    {
        parent::__construct($header);
        $this->data = new PageContents();
    }

    /**
     * @return PageDescriptionInterface
     */
    public function getPageDescription(): PageDescriptionInterface
    {
        return $this->data;
    }

    /**
     * @param PageContents $contents
     * @return ContentStream
     */
    public function appendPageContents(PageContents $contents): ContentStream
    {
        $this->data->append($contents);
        return $this;
    }
}
