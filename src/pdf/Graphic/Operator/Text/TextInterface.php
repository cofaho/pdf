<?php

namespace pdf\Graphic\Operator\Text;


use pdf\Document\Page\PageContentsInterface;

interface TextInterface extends TextPositioning, TextShowingInterface, TextStateInterface
{
    public function endText(): PageContentsInterface;
}
