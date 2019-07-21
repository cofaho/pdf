<?php

namespace pdf\Graphic\Operator;


use pdf\Document\Page\PageContentsInterface;
use pdf\ObjectType\NameObject;

trait ShadingObject
{
    /**
     * @param string|NameObject $name
     * @return PageContentsInterface
     */
    public function addShadingObject($name): PageContentsInterface
    {
        $this->data[] = $name . ' sh';
        return $this;
    }
}
