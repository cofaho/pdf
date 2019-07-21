<?php

namespace pdf\Graphic\Operator;


use pdf\Document\Page\PageDescriptionInterface;

interface ExternalObjectInterface
{
    public function addXObject($name): PageDescriptionInterface;
}
