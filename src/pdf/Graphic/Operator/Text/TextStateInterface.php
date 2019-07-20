<?php

namespace pdf\Graphic\Operator\Text;


use pdf\ObjectType\NameObject;

interface TextStateInterface
{
    /**
     * @param float $charSpace
     * @return $this
     */
    public function setCharacterSpacing(float $charSpace);

    /**
     * @param float $wordSpace
     * @return $this
     */
    public function setWordSpacing(float $wordSpace);

    /**
     * @param float $scale
     * @return $this
     */
    public function setHorizontalScaling(float $scale);

    /**
     * @param $leading
     * @return $this
     */
    public function setLeading($leading);
    /**
     * @param string|NameObject $font
     * @param float $size
     * @return $this
     */
    public function setFont($font, float $size);

    /**
     * @param int $render
     * @return $this
     */
    public function setRenderingMode(int $render);

    /**
     * @param int $rise
     * @return $this
     */
    public function setRise(int $rise);
}
