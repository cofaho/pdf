<?php

namespace pdf\Document\Page;


use pdf\Graphic\Operator\ColorInterface;
use pdf\Graphic\Operator\ExternalObjectInterface;
use pdf\Graphic\Operator\GeneralGraphicsStateInterface;
use pdf\Graphic\Operator\MarkedContentInterface;
use pdf\Graphic\Operator\Path\PathBeginInterface;
use pdf\Graphic\Operator\Path\PathInterface;
use pdf\Graphic\Operator\ShadingObjectInterface;
use pdf\Graphic\Operator\SpecialGraphicsStateInterface;
use pdf\Graphic\Operator\Text\TextBeginInterface;
use pdf\Graphic\Operator\Text\TextInterface;

interface PageContentsInterface extends
    ColorInterface,
    PathBeginInterface,
    PathInterface,
    TextBeginInterface,
    TextInterface,
    GeneralGraphicsStateInterface,
    SpecialGraphicsStateInterface,
    ExternalObjectInterface,
    ShadingObjectInterface,
    MarkedContentInterface
{

}
