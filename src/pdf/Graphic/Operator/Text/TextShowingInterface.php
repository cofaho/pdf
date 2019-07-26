<?php

namespace pdf\Graphic\Operator\Text;


use pdf\ObjectType\ArrayObject;

interface TextShowingInterface
{
    public function addText(string $text): TextInterface;

    public function addTextOnNextLine(string $text): TextInterface;

    public function addTextOnNextLineWithSpacings($aw, $ac, string $text): TextInterface;

    public function addTexts(ArrayObject $texts): TextInterface;
}
