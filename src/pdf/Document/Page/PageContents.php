<?php

namespace pdf\Document\Page;


use pdf\Graphic\Operator\Color;
use pdf\Graphic\Operator\ExternalObject;
use pdf\Graphic\Operator\GeneralGraphicsState;
use pdf\Graphic\Operator\MarkedContent;
use pdf\Graphic\Operator\Path\PathBeginInterface;
use pdf\Graphic\Operator\ShadingObject;
use pdf\Graphic\Operator\SpecialGraphicsState;
use pdf\Graphic\Operator\Text\TextInterface;
use pdf\Graphic\Path;
use pdf\Graphic\Text;

class PageContents implements PageContentsInterface
{
    use Path, Text, GeneralGraphicsState, SpecialGraphicsState, Color, ExternalObject, MarkedContent, ShadingObject;

    protected $operators = [];

    /**
     * @return string
     */
    public function __toString(): string
    {
        return join("\n", $this->operators);
    }

    public static function createPath(): PathBeginInterface
    {
        return new PageContents();
    }

    public static function createText(): TextInterface
    {
        return (new PageContents())->beginText();
    }

}
