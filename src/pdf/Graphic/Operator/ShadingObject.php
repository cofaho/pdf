<?php

namespace pdf\Graphic\Operator;


use pdf\Document\Page\PageDescriptionInterface;
use pdf\ObjectType\NameObject;

trait ShadingObject
{
    /**
     * @param string|NameObject $name
     * @return PageDescriptionInterface
     */
    public function addShadingObject($name): PageDescriptionInterface
    {
        $this->data[] = $name . ' sh';
        return $this;
    }
}
