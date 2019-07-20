<?php

namespace pdf\Graphic\Operator;


use InvalidArgumentException;
use pdf\Helper\Math;
use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\NameObject;

trait GeneralGraphicsState
{
    /**
     * @param float $width
     * @return $this
     */
    public function setLineWidth(float $width)
    {
        $this->operators[] = Math::floatToStr($width) . ' w';
        return $this;
    }

    /**
     * @param int $style
     * @return $this
     */
    public function setLineCap(int $style)
    {
        $this->operators[] = $style . ' J';
        return $this;
    }

    /**
     * @param int $style
     * @return $this
     */
    public function setLineJoin(int $style)
    {
        $this->operators[] = $style . ' j';
        return $this;
    }

    /**
     * @param float $limit
     * @return $this
     */
    public function setMiterLimit(float $limit)
    {
        $this->operators[] = Math::floatToStr($limit) . ' M';
        return $this;
    }

    /**
     * @param ArrayObject $dashArray
     * @param int $dashPhase
     * @return $this
     */
    public function setDashPattern(ArrayObject $dashArray, int $dashPhase)
    {
        $this->operators[] = $dashArray . ' ' . $dashPhase . ' d';
        return $this;
    }

    /**
     * @param string $intent value from RenderingIntent
     * @return $this
     */
    public function setColorIntent(string $intent)
    {
        $this->operators[] = $intent . ' ri';
        return $this;
    }

    /**
     * @param int $tolerance
     * @return $this
     */
    public function setFlatnessTolerance(int $tolerance)
    {
        if ($tolerance < 0 || $tolerance > 100) {
            throw new InvalidArgumentException('Tolerance should be in the range [0, 100]');
        }
        $this->operators[] = $tolerance . ' i';
        return $this;
    }

    /**
     * @param string|NameObject $name
     * @return $this
     */
    public function setGraphicsState($name)
    {
        $this->operators[] = $name . ' gs';
        return $this;
    }

}
