<?php

namespace pdf\Graphic\Operator;


use pdf\Document\Page\PageDescriptionInterface;
use pdf\ObjectType\NameObject;

interface ShadingObjectInterface
{
    /**
     * @param string|NameObject $name
     * @return PageDescriptionInterface
     */
    public function addShadingObject($name): PageDescriptionInterface;
}
