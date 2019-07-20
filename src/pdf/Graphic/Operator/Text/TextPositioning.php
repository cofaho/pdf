<?php

namespace pdf\Graphic\Operator\Text;


use pdf\DataStructure\Matrix;

interface TextPositioning
{
    public function nextLine($tx, $ty): TextInterface;

    public function nextLineSetLeading($tx, $ty): TextInterface;

    public function setMatrix(Matrix $matrix): TextInterface;

    public function nextLineStart(): TextInterface;
}
