<?php

namespace pdf\Graphic;


use pdf\DataStructure\Point;

class Path extends AbstractGraphic
{
    protected $parts = [];

    protected $isFinished = true;

    /**
     * Path constructor.
     * @param $x
     * @param $y
     */
    public function __construct($x = null, $y = null)
    {
        if ($x !== null && $y !== null) {
            $this->begin($x, $y);
        }
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        if (!$this->isFinished) {
            $this->stroke();
        }
        return join("\n", $this->parts);
    }

    /**
     * @param $x
     * @param $y
     * @return $this
     */
    public function lineTo($x, $y)
    {
        if ($this->isFinished) {
            $this->begin($x, $y);
        } else {
            $this->parts[] = "$x $y l";
        }
        return $this;
    }

    /**
     * @param Point|null $p1 control point for current position
     * @param Point|null $p2 control point for final position
     * @param Point $p3 final point of the curve
     * @return $this
     */
    public function bezierCurve(Point $p1, Point $p2, Point $p3)
    {
        if ($this->isFinished) {
            $this->begin($p1->x, $p1->y);
        }

        if ($p1 === null) {
            if ($p2 === null) {
                $this->lineTo($p3->x, $p3->y);
            }
            $this->parts[] = "{$p2->getXY()} {$p3->getXY()} v";
        } elseif ($p2 === null) {
            $this->parts[] = "{$p1->getXY()} {$p3->getXY()} y";
        } else {
            $this->parts[] = "{$p1->getXY()} {$p2->getXY()} {$p3->getXY()} c";
        }

        return $this;
    }

    /**
     * @param $x
     * @param $y
     * @return $this
     */
    public function begin($x, $y)
    {
        if (!$this->isFinished) {
            $this->stroke();
        }
        $this->parts[] = "$x $y m";
        $this->isFinished = false;
        return $this;
    }

    /**
     * @return $this
     */
    public function close()
    {
        if (!$this->isFinished) {
            $this->parts[] = 'h';
            $this->isFinished = true;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function end()
    {
        if (!$this->isFinished) {
            $this->parts[] = 'n';
            $this->isFinished = true;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function closeAndStroke()
    {
        if (!$this->isFinished) {
            $this->parts[] = 's';
            $this->isFinished = true;
        }

        return $this;
    }

    /**
     * @param bool $useEvenOddRule
     * @return $this
     */
    public function fillAndStroke($useEvenOddRule = false)
    {
        if (!$this->isFinished) {
            $this->parts[] = 'B';
            if ($useEvenOddRule) {
                $this->parts[] = '*';
            }
            $this->isFinished = true;
        }

        return $this;
    }

    /**
     * @param bool $useEvenOddRule
     * @return $this
     */
    public function closeFillAndStroke($useEvenOddRule = false)
    {
        if (!$this->isFinished) {
            $this->parts[] = 'b';
            if ($useEvenOddRule) {
                $this->parts[] = '*';
            }
            $this->isFinished = true;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function stroke()
    {
        if (!$this->isFinished) {
            $this->parts[] = 'S';
            $this->isFinished = true;
        }

        return $this;
    }

    /**
     * @param bool $useEvenOddRule
     * @return $this
     */
    public function fill($useEvenOddRule = false)
    {
        if (!$this->isFinished) {
            $this->parts[] = 'f';
            if ($useEvenOddRule) {
                $this->parts[] = '*';
            }
            $this->isFinished = true;
        }

        return $this;
    }

    /**
     * @param $x
     * @param $y
     * @param $width
     * @param $height
     * @return $this
     */
    public function rectangle($x, $y, $width, $height)
    {
        $this->parts[] = "$x $y $width $height re";
        $this->isFinished = false;
        return $this;
    }

    public function setFillColor()
    {

    }
}
