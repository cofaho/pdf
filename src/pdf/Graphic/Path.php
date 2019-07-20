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
        $this->operators[] = "$x $y m";
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
        $this->operators[] = "$x $y $width $height re";
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
        $this->operators[] = "$x $y l";
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
            $this->operators[] = $p2 . ' ' . $p3 . ' v';
        } elseif ($p2 === null) {
            $this->operators[] = $p1 . ' ' . $p3 . ' y';
        } else {
            $this->operators[] = $p1 . ' ' . $p2 . ' ' . $p3 . ' c';
        }
        return $this;
    }

    /**
     * @return PathInterface
     */
    public function closePath(): PathInterface
    {
        $this->operators[] = 'h';
        return $this;
    }

    /**
     * @param bool $useEvenOddRule
     * @return PathPaintingInterface
     */
    public function clip($useEvenOddRule = false): PathPaintingInterface
    {
        $this->operators[] = 'W' . ($useEvenOddRule ? '*' : '');
        return $this;
    }

    /**
     * @return PageContentsInterface
     */
    public function stroke(): PageContentsInterface
    {
        $this->operators[] = 'S';
        return $this;
    }

    /**
     * @return PageContentsInterface
     */
    public function closeAndStroke(): PageContentsInterface
    {
        $this->operators[] = 's';
        return $this;
    }

    /**
     * @param bool $useEvenOddRule
     * @return PageContentsInterface
     */
    public function fill($useEvenOddRule = false): PageContentsInterface
    {
        $this->operators[] = 'f' . ($useEvenOddRule ? '*' : '');
        return $this;
    }

    /**
     * @param bool $useEvenOddRule
     * @return PageContentsInterface
     */
    public function fillAndStroke($useEvenOddRule = false): PageContentsInterface
    {
        $this->operators[] = 'B' . ($useEvenOddRule ? '*' : '');
        return $this;
    }

    /**
     * @param bool $useEvenOddRule
     * @return PageContentsInterface
     */
    public function closeFillAndStroke($useEvenOddRule = false): PageContentsInterface
    {
        $this->operators[] = 'b' . ($useEvenOddRule ? '*' : '');
        return $this;
    }

    /**
     * @return PageContentsInterface
     */
    public function endPath(): PageContentsInterface
    {
        $this->operators[] = 'n';
        return $this;
    }
}
