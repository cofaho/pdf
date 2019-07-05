<?php

namespace pdf\DataStructure;


class Point
{
    /**
     * @var float
     */
    public $x = 0;
    /**
     * @var float
     */
    public $y = 0;

    /**
     * @param int|float $x
     * @param int|float $y
     */
    public function __construct($x = 0, $y = 0)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @param float $x
     * @param float $y
     * @return Point
     */
    public function setXY($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
        return $this;
    }

    /**
     * @param string $glue
     * @return string
     */
    public function getXY($glue = ' ')
    {
        return $this->x . $glue . $this->y;
    }

}
