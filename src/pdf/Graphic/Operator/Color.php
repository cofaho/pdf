<?php

namespace pdf\Graphic\Operator;


use InvalidArgumentException;
use pdf\Helper\Math;
use pdf\ObjectType\NameObject;

trait Color
{
    /**
     * @param string|NameObject $name
     * @return $this
     */
    public function setColorSpaceForStroking($name)
    {
        $this->data[] = $name . ' CS';
        return $this;
    }

    /**
     * @param string|NameObject $name
     * @return $this
     */
    public function setColorSpaceForNonStroking($name)
    {
        $this->data[] = $name . ' cs';
        return $this;
    }

    /**
     * @param array $color
     * @return $this
     */
    public function setStrokeColor(array $color)
    {
        $this->data[] = $color . ' SC';
        return $this;
    }

    /**
     * @param array $color
     * @param null|string|NameObject $name pattern name
     * @return $this
     */
    public function setStrokeColorN(array $color, $name = null)
    {
        $this->data[] = implode(' ', $color) . ($name === null ? '' : ' ' . $name) . ' SCN';
        return $this;
    }

    /**
     * @param array $color
     * @return $this
     */
    public function setFillColor(array $color)
    {
        $this->data[] = implode(' ', $color) . ' sc';
        return $this;
    }

    /**
     * @param array $color
     * @param null|string|NameObject $name pattern name
     * @return $this
     */
    public function setFillColorN(array $color, $name = null)
    {
        $this->data[] = implode(' ', $color) . ($name === null ? '' : ' ' . $name) . ' scn';
        return $this;
    }

    /**
     * @param float $gray
     * @return $this
     */
    public function setStrokeGray(float $gray)
    {
        if ($gray < 0 || $gray > 1) {
            throw new InvalidArgumentException('Gray should be in the range [0.0, 1.0]');
        }
        $this->data[] = Math::floatToStr($gray) . ' G';
        return $this;
    }

    /**
     * @param float $gray
     * @return $this
     */
    public function setFillGray(float $gray)
    {
        if ($gray < 0 || $gray > 1) {
            throw new InvalidArgumentException('Gray should be in the range [0.0, 1.0]');
        }
        $this->data[] = Math::floatToStr($gray) . ' g';
        return $this;
    }

    /**
     * @param array $rgb
     * @return $this
     */
    public function setStrokeRGB(array $rgb)
    {
        foreach ($rgb as $c) {
            $c = (float)$c;
            if ($c < 0 || $c > 1) {
                throw new InvalidArgumentException('RGB operands should be in the range [0.0, 1.0]');
            }
        }
        $this->data[] = $rgb . ' RG';
        return $this;
    }

    /**
     * @param array $rgb
     * @return $this
     */
    public function setFillRGB(array $rgb)
    {
        foreach ($rgb as &$c) {
            $c = (float)$c;
            if ($c < 0 || $c > 1) {
                throw new InvalidArgumentException('RGB operands should be in the range [0.0, 1.0]');
            }
            $c = Math::floatToStr($c);
        }
        $this->data[] = implode(' ', $rgb) . ' rg';
        return $this;
    }

    /**
     * @param array $cmyk
     * @return $this
     */
    public function setStrokeCMYK(array $cmyk)
    {
        foreach ($cmyk as &$c) {
            $c = (float)$c;
            if ($c < 0 || $c > 1) {
                throw new InvalidArgumentException('CMYK operands should be in the range [0.0, 1.0]');
            }
            $c = Math::floatToStr($c);
        }
        $this->data[] = implode(' ', $cmyk) . ' K';
        return $this;
    }

    /**
     * @param array $cmyk
     * @return $this
     */
    public function setFillCMYK(array $cmyk)
    {
        foreach ($cmyk as &$c) {
            $c = (float)$c;
            if ($c < 0 || $c > 1) {
                throw new InvalidArgumentException('CMYK operands should be in the range [0.0, 1.0]');
            }
            $c = Math::floatToStr($c);
        }
        $this->data[] = implode(' ', $cmyk) . ' k';
        return $this;
    }

}
