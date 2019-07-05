<?php

namespace pdf\Transparency;


use pdf\Graphic\XObject\XObjectGroupHeader;
use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\NameObject;

/**
 * @property NameObject S
 * @property NameObject|ArrayObject CS color space
 * @property bool I isolated
 * @property bool K knockout
 */
class XObjectGroupTransparencyHeader extends XObjectGroupHeader
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->S = '/Transparency';
    }
}
