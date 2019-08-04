<?php

namespace pdf\Graphic\Operator;


use pdf\Document\Page\PageDescriptionInterface;
use pdf\ObjectType\NameObject;

trait ExternalObject
{
    /**
     * @param string|NameObject $name
     * @return PageDescriptionInterface
     */
    public function addXObject($name): PageDescriptionInterface
    {
        $this->data[] = $name . ' Do';
        return $this;
    }
}
