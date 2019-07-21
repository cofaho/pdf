<?php

namespace pdf\Graphic;


use pdf\DataStructure\Matrix;
use pdf\Document\Page\PageDescriptionInterface;
use pdf\Graphic\Operator\Text\TextInterface;
use pdf\Helper\Math;
use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\NameObject;
use pdf\ObjectType\StringObject;

trait Text
{
    /**
     * @return TextInterface
     */
    public function beginText(): TextInterface
    {
        $this->data[] = 'BT';
        return $this;
    }

    /**
     * @return PageDescriptionInterface
     */
    public function endText(): PageDescriptionInterface
    {
        $this->data[] = 'ET';
        return $this;
    }

    /**
     * @param float $charSpace default is 0
     * @return $this
     */
    public function setCharacterSpacing(float $charSpace)
    {
        $this->data[] = Math::floatToStr($charSpace) . ' Tc';
        return $this;
    }

    /**
     * @param float $wordSpace default is 0
     * @return $this
     */
    public function setWordSpacing(float $wordSpace)
    {
        $this->data[] = Math::floatToStr($wordSpace) . ' Tw';
        return $this;
    }

    /**
     * @param float $scale default is 100
     * @return $this
     */
    public function setHorizontalScaling(float $scale)
    {
        $this->data[] = Math::floatToStr($scale) . ' Tz';
        return $this;
    }

    /**
     * @param $leading
     * @return $this
     */
    public function setLeading($leading)
    {
        $this->data[] = $leading . ' TL';
        return $this;
    }

    /**
     * @param string|NameObject $font
     * @param float $size
     * @return $this
     */
    public function setFont($font, float $size)
    {
        $this->data[] = $font . ' ' . Math::floatToStr($size) . ' Tf';
        return $this;
    }

    /**
     * @param int $render
     * @return $this
     */
    public function setRenderingMode(int $render)
    {
        $this->data[] = $render . ' Tr';
        return $this;
    }

    /**
     * @param int $rise
     * @return $this
     */
    public function setRise(int $rise)
    {
        $this->data[] = $rise . ' Ts';
        return $this;
    }

    /**
     * @param $tx
     * @param $ty
     * @return TextInterface
     */
    public function nextLine($tx, $ty): TextInterface
    {
        $this->data[] = $tx . ' ' . $ty . ' Td';
        return $this;
    }

    /**
     * @param $tx
     * @param $ty
     * @return TextInterface
     */
    public function nextLineSetLeading($tx, $ty): TextInterface
    {
        $this->data[] = $tx . ' ' . $ty . ' TD';
        return $this;
    }

    /**
     * @param Matrix $matrix
     * @return TextInterface
     */
    public function setMatrix(Matrix $matrix): TextInterface
    {
        $this->data[] = $matrix . ' Tm';
        return $this;
    }

    /**
     * @return TextInterface
     */
    public function nextLineStart(): TextInterface
    {
        $this->data[] = 'T*';
        return $this;
    }

    /**
     * @param string $text
     * @return TextInterface
     */
    public function addText(string $text): TextInterface
    {
        $oText = new StringObject($text);
        $this->data[] = $oText . ' Tj';
        return $this;
    }

    /**
     * @param StringObject $text
     * @return TextInterface
     */
    public function addTextOnNextLine(StringObject $text): TextInterface
    {
        $this->data[] = $text . " '";
        return $this;
    }

    /**
     * @param float $aw Word spacing
     * @param float $ac Character spacing
     * @param StringObject $text
     * @return TextInterface
     */
    public function addTextOnNextLineWithSpacings($aw, $ac, StringObject $text): TextInterface
    {
        $this->data[] = "$aw $ac $text \"";
        return $this;
    }

    /**
     * @param ArrayObject $texts
     * @return TextInterface
     */
    public function addTexts(ArrayObject $texts): TextInterface
    {
        $this->data[] = $texts . ' TJ';
        return $this;
    }
}
