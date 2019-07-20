<?php

namespace pdf\Graphic\Operator\Path;


use pdf\DataStructure\Point;

interface PathConstructionInterface extends PathBeginInterface
{
    public function lineTo(float $x, float $y): PathInterface;

    public function bezierCurve(Point $p1, Point $p2, Point $p3): PathInterface;

    public function closePath(): PathInterface;
}
