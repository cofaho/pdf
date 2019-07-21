<?php

namespace pdf\Graphic\Operator;


use pdf\Document\Page\PageContentsInterface;

trait ExternalObject
{
    /**
     * @param $name
     * @return PageContentsInterface
     */
    public function addXObject($name): PageContentsInterface
    {
        $this->data[] = $name . ' Do';
        return $this;
    }
}
