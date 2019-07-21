<?php

namespace pdf\Graphic\Operator;


use pdf\Document\Page\PageDescriptionInterface;

trait ExternalObject
{
    /**
     * @param $name
     * @return PageDescriptionInterface
     */
    public function addXObject($name): PageDescriptionInterface
    {
        $this->data[] = $name . ' Do';
        return $this;
    }
}
