<?php

namespace pdf\Graphic;


use pdf\DataStructure\Matrix;
use pdf\Document\Page\PageContentsInterface;
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
        $this->operators[] = 'BT';
        return $this;
    }

    /**
     * @return PageContentsInterface
     */
    public function endText(): PageContentsInterface
    {
        $this->operators[] = 'ET';
        return $this;
    }

    /**
     * @param float $charSpace default is 0
     * @return $this
     */
    public function setCharacterSpacing(float $charSpace)
    {
        $this->operators[] = Math::floatToStr($charSpace) . ' Tc';
        return $this;
    }

    /**
     * @param float $wordSpace default is 0
     * @return $this
     */
    public function setWordSpacing(float $wordSpace)
    {
        $this->operators[] = Math::floatToStr($wordSpace) . ' Tw';
        return $this;
    }

    /**
     * @param float $scale default is 100
     * @return $this
     */
    public function setHorizontalScaling(float $scale)
    {
        $this->operators[] = Math::floatToStr($scale) . ' Tz';
        return $this;
    }

    /**
     * @param $leading
     * @return $this
     */
    public function setLeading($leading)
    {
        $this->operators[] = $leading . ' TL';
        return $this;
    }

    /**
     * @param string|NameObject $font
     * @param float $size
     * @return $this
     */
    public function setFont($font, float $size)
    {
        $this->operators[] = $font . ' ' . Math::floatToStr($size) . ' Tf';
        return $this;
    }

    /**
     * @param int $render
     * @return $this
     */
    public function setRenderingMode(int $render)
    {
        $this->operators[] = $render . ' Tr';
        return $this;
    }

    /**
     * @param int $rise
     * @return $this
     */
    public function setRise(int $rise)
    {
        $this->operators[] = $rise . ' Ts';
        return $this;
    }

    /**
     * @param $tx
     * @param $ty
     * @return TextInterface
     */
    public function nextLine($tx, $ty): TextInterface
    {
        $this->operators[] = $tx . ' ' . $ty . ' Td';
        return $this;
    }

    /**
     * @param $tx
     * @param $ty
     * @return TextInterface
     */
    public function nextLineSetLeading($tx, $ty): TextInterface
    {
        $this->operators[] = $tx . ' ' . $ty . ' TD';
        return $this;
    }

    /**
     * @param Matrix $matrix
     * @return TextInterface
     */
    public function setMatrix(Matrix $matrix): TextInterface
    {
        $this->operators[] = $matrix . ' Tm';
        return $this;
    }

    /**
     * @return TextInterface
     */
    public function nextLineStart(): TextInterface
    {
        $this->operators[] = 'T*';
        return $this;
    }

    /**
     * @param string $text
     * @return TextInterface
     */
    public function addText(string $text): TextInterface
    {
        $oText = new StringObject($text);
        $this->operators[] = $oText . ' Tj';
        return $this;
    }

    /**
     * @param StringObject $text
     * @return TextInterface
     */
    public function addTextOnNextLine(StringObject $text): TextInterface
    {
        $this->operators[] = $text . " '";
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
        $this->operators[] = "$aw $ac $text \"";
        return $this;
    }

    /**
     * @param ArrayObject $texts
     * @return TextInterface
     */
    public function addTexts(ArrayObject $texts): TextInterface
    {
        $this->operators[] = $texts . ' TJ';
        return $this;
    }
}
