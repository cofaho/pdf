<?php

namespace pdf\Document\Page;


use pdf\Graphic\Operator\Color;
use pdf\Graphic\Operator\ExternalObject;
use pdf\Graphic\Operator\GeneralGraphicsState;
use pdf\Graphic\Operator\MarkedContent;
use pdf\Graphic\Operator\Path\PathInterface;
use pdf\Graphic\Operator\ShadingObject;
use pdf\Graphic\Operator\SpecialGraphicsState;
use pdf\Graphic\Operator\Text\TextInterface;
use pdf\Graphic\Path;
use pdf\Graphic\Text;

class PageContents implements PageDescriptionInterface, PathInterface, TextInterface
{
    use Path, Text, Color,
        GeneralGraphicsState, SpecialGraphicsState,
        ExternalObject, ShadingObject, MarkedContent;
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @return string
     */
    public function __toString(): string
    {
        return implode("\n", $this->data);
    }

    /**
     * @param PageContents $contents
     * @return PageContents
     */
    public function append(PageContents $contents): PageContents
    {
        $this->data = array_merge($this->data, $contents->data);
        return $this;
    }
}
