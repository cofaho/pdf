<?php

namespace pdf\Graphic\Operator\Text;


use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\StringObject;

interface TextShowingInterface
{
    public function addText(string $text): TextInterface;

    public function addTextOnNextLine(StringObject $text): TextInterface;

    public function addTextOnNextLineWithSpacings($aw, $ac, StringObject $text): TextInterface;

    public function addTexts(ArrayObject $texts): TextInterface;
}
