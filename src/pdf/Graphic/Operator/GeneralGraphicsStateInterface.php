<?php

namespace pdf\Graphic\Operator;

use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\NameObject;

interface GeneralGraphicsStateInterface
{
    /**
     * @param float $width
     * @return $this
     */
    public function setLineWidth(float $width);

    /**
     * @param int $style
     * @return $this
     */
    public function setLineCap(int $style);

    /**
     * @param int $style
     * @return $this
     */
    public function setLineJoin(int $style);

    /**
     * @param float $limit
     * @return $this
     */
    public function setMiterLimit(float $limit);

    /**
     * @param ArrayObject $dashArray
     * @param int $dashPhase
     * @return $this
     */
    public function setDashPattern(ArrayObject $dashArray, int $dashPhase);

    /**
     * @param string $intent value from RenderingIntent
     * @return $this
     */
    public function setColorIntent(string $intent);

    /**
     * @param int $tolerance
     * @return $this
     */
    public function setFlatnessTolerance(int $tolerance);

    /**
     * @param string|NameObject $name
     * @return $this
     */
    public function setGraphicsState($name);
}
