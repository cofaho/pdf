<?php

namespace pdf\Graphic\Operator\Text;


use pdf\Document\Page\PageDescriptionInterface;

interface TextInterface extends TextPositioning, TextShowingInterface, TextStateInterface
{
    public function endText(): PageDescriptionInterface;
}
