<?php

namespace pdf\Graphic\Operator;


use pdf\Document\Page\PageContentsInterface;

interface ExternalObjectInterface
{
    public function addXObject($name): PageContentsInterface;
}
