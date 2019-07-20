<?php

namespace pdf\Graphic\Operator\Path;


interface PathClippingInterface
{
    public function clip($useEvenOddRule = false): PathPaintingInterface;
}
