<?php

namespace pdf\Graphic\Operator;


use pdf\ObjectType\NameObject;

interface ColorInterface
{
    /**
     * @param string|NameObject $name
     * @return $this
     */
    public function setColorSpaceForStroking($name);

    /**
     * @param string|NameObject $name
     * @return $this
     */
    public function setColorSpaceForNonStroking($name);

    /**
     * @param array $color
     * @return $this
     */
    public function setStrokeColor(array $color);

    /**
     * @param array $color
     * @param null|string|NameObject $name pattern name
     * @return $this
     */
    public function setStrokeColorN(array $color, $name = null);

    /**
     * @param array $color
     * @return $this
     */
    public function setFillColor(array $color);

    /**
     * @param array $color
     * @param null|string|NameObject $name pattern name
     * @return $this
     */
    public function setFillColorN(array $color, $name = null);

    /**
     * @param float $gray
     * @return $this
     */
    public function setStrokeGray(float $gray);

    /**
     * @param float $gray
     * @return $this
     */
    public function setFillGray(float $gray);

    /**
     * @param array $rgb
     * @return $this
     */
    public function setStrokeRGB(array $rgb);

    /**
     * @param array $rgb
     * @return $this
     */
    public function setFillRGB(array $rgb);

    /**
     * @param array $cmyk
     * @return $this
     */
    public function setStrokeCMYK(array $cmyk);

    /**
     * @param array $cmyk
     * @return $this
     */
    public function setFillCMYK(array $cmyk);
}
