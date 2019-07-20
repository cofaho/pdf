<?php

namespace pdf\Graphic\Operator\Path;


interface PathBeginInterface
{
    public function moveTo(float $x, float $y): PathInterface;

    public function rectangle(float $x, float $y, float $width, float $height): PathInterface;
}
