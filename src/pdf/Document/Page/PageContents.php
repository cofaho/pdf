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

    public function __toString()
    {
        return implode("\n", $this->data);
    }
}
