<?php

namespace pdf\DataStructure;


use pdf\ObjectType\ArrayObject;

/**
 * @property float lowerLeftX
 * @property float lowerLeftY
 */
class Rectangle extends ArrayObject
{
    public static $LOWER_LEFT_X = 0;
    public static $LOWER_LEFT_Y = 1;
    public static $UPPER_RIGHT_X = 2;
    public static $UPPER_RIGHT_Y = 3;

    public function __construct(?array $config = null)
    {
        parent::__construct($config);
    }

    public function setLowerLeft(Point $point)
    {
        $this->items[self::$LOWER_LEFT_X] = $point->x;
        $this->items[self::$LOWER_LEFT_Y] = $point->y;
        return $this;
    }

    public function setUpperRight(Point $point)
    {
        $this->items[self::$UPPER_RIGHT_X] = $point->x;
        $this->items[self::$UPPER_RIGHT_Y] = $point->y;
        return $this;
    }
}
