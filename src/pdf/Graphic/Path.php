<?php

namespace pdf\Graphic;


use pdf\DataStructure\Point;
use pdf\Document\Page\PageContentsInterface;
use pdf\Graphic\Operator\Path\PathInterface;
use pdf\Graphic\Operator\Path\PathPaintingInterface;
use pdf\Helper\Math;

trait Path
{
    /**
     * @param float $x
     * @param float $y
     * @return PathInterface
     */
    public function moveTo(float $x, float $y): PathInterface
    {
        $x = Math::floatToStr($x);
        $y = Math::floatToStr($y);
        $this->data[] = "$x $y m";
        return $this;
    }

    /**
     * @param float $x
     * @param float $y
     * @param float $width
     * @param float $height
     * @return PathInterface
     */
    public function rectangle(float $x, float $y, float $width, float $height): PathInterface
    {
        $x = Math::floatToStr($x);
        $y = Math::floatToStr($y);
        $width = Math::floatToStr($width);
        $height = Math::floatToStr($height);
        $this->data[] = "$x $y $width $height re";
        return $this;
    }

    /**
     * @param float $x
     * @param float $y
     * @return PathInterface
     */
    public function lineTo(float $x, float $y): PathInterface
    {
        $x = Math::floatToStr($x);
        $y = Math::floatToStr($y);
        $this->data[] = "$x $y l";
        return $this;
    }

    /**
     * @param Point $p1
     * @param Point $p2
     * @param Point $p3
     * @return PathInterface
     */
    public function bezierCurve(Point $p1, Point $p2, Point $p3): PathInterface
    {
        if ($p1 === null) {
            if ($p2 === null) {
                $this->lineTo($p3->x, $p3->y);
            }
            $this->data[] = $p2 . ' ' . $p3 . ' v';
        } elseif ($p2 === null) {
            $this->data[] = $p1 . ' ' . $p3 . ' y';
        } else {
            $this->data[] = $p1 . ' ' . $p2 . ' ' . $p3 . ' c';
        }
        return $this;
    }

    /**
     * @return PathInterface
     */
    public function closePath(): PathInterface
    {
        $this->data[] = 'h';
        return $this;
    }

    /**
     * @param bool $useEvenOddRule
     * @return PathPaintingInterface
     */
    public function clip($useEvenOddRule = false): PathPaintingInterface
    {
        $this->data[] = 'W' . ($useEvenOddRule ? '*' : '');
        return $this;
    }

    /**
     * @return PageContentsInterface
     */
    public function stroke(): PageContentsInterface
    {
        $this->data[] = 'S';
        return $this;
    }

    /**
     * @return PageContentsInterface
     */
    public function closeAndStroke(): PageContentsInterface
    {
        $this->data[] = 's';
        return $this;
    }

    /**
     * @param bool $useEvenOddRule
     * @return PageContentsInterface
     */
    public function fill($useEvenOddRule = false): PageContentsInterface
    {
        $this->data[] = 'f' . ($useEvenOddRule ? '*' : '');
        return $this;
    }

    /**
     * @param bool $useEvenOddRule
     * @return PageContentsInterface
     */
    public function fillAndStroke($useEvenOddRule = false): PageContentsInterface
    {
        $this->data[] = 'B' . ($useEvenOddRule ? '*' : '');
        return $this;
    }

    /**
     * @param bool $useEvenOddRule
     * @return PageContentsInterface
     */
    public function closeFillAndStroke($useEvenOddRule = false): PageContentsInterface
    {
        $this->data[] = 'b' . ($useEvenOddRule ? '*' : '');
        return $this;
    }

    /**
     * @return PageContentsInterface
     */
    public function endPath(): PageContentsInterface
    {
        $this->data[] = 'n';
        return $this;
    }
}
