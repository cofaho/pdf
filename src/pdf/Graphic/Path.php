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
    public function __construct($x, $y)
    {
        $this->begin($x, $y);
        parent::__construct();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        if (!$this->isFinished) {
            $this->stroke();
        }
        $this->data = join('', $this->parts);
        return parent::__toString();
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
            $this->parts[] = "\n$x $y l";
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
            $this->parts[] = "{$p2->getXY()} {$p3->getXY()} v\n";
        } elseif ($p2 === null) {
            $this->parts[] = "{$p1->getXY()} {$p3->getXY()} y\n";
        } else {
            $this->parts[] = "{$p1->getXY()} {$p2->getXY()} {$p3->getXY()} c\n";
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
            $this->parts[] = "\nh";
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
            $this->parts[] = "\nn";
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
            $this->parts[] = "\ns";
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
            $this->parts[] = "\nB";
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
            $this->parts[] = "\nb";
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
            $this->parts[] = "\nS";
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
            $this->parts[] = "\nf";
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
        if ($this->isFinished) {
            $this->stroke();
        }
        $this->parts[] = "$x $y $width $height re\n";
        $this->isFinished = true;
        return $this;
    }
}
