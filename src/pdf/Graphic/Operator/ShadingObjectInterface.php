<?php

namespace pdf\Graphic\Operator;


use pdf\Document\Page\PageContentsInterface;
use pdf\ObjectType\NameObject;

interface ShadingObjectInterface
{
    /**
     * @param string|NameObject $name
     * @return PageContentsInterface
     */
    public function addShadingObject($name): PageContentsInterface;
}
