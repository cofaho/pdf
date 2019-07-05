<?php

namespace pdf\Graphic;


use pdf\DataStructure\Matrix;
use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\StringObject;

class Text extends AbstractGraphic
{
    const RENDERING_MODE_FILL = 0;

    const RENDERING_MODE_STROKE = 1;

    const RENDERING_MODE_FILL_STROKE = 2;

    const RENDERING_MODE_INVISIBLE = 3;

    const RENDERING_MODE_FILL_CLIP = 4;

    const RENDERING_MODE_STROKE_CLIP = 5;

    const RENDERING_MODE_FILL_STROKE_CLIP = 6;

    const RENDERING_MODE_CLIP = 7;
    /**
     * @var array
     */
    protected $operators = [];

    public function __construct($text = null)
    {
        if ($text !== null) {
            if (!($text instanceof StringObject)) {
                $text = new StringObject($text);
            }
            $this->showText($text);
        }
        parent::__construct();
    }

    public function __toString()
    {
        $this->data = "BT\n/F1 22 Tf\n{$this->getOperators()}\nET";

        return parent::__toString();
    }

    /**
     * @param float $charSpace default is 0
     * @return $this
     */
    public function setCharacterSpacing(float $charSpace)
    {
        $this->operators[] = $charSpace . ' Tc';
        return $this;
    }

    /**
     * @param float $wordSpace default is 0
     * @return $this
     */
    public function setWordSpacing(float $wordSpace)
    {
        $this->operators[] = $wordSpace . ' Tw';
        return $this;
    }

    /**
     * @param float $scale default is 100
     * @return $this
     */
    public function setHorizontalScaling(float $scale)
    {
        $this->operators[] = $scale . ' Tz';
        return $this;
    }

    public function setLeading($leading)
    {
        $this->operators[] = $leading . ' TL';
        return $this;
    }

    public function setFont($font, $size)
    {
        $this->operators[] = $font . ' ' . $size . ' Tf';
        return $this;
    }

    public function setRenderingMode($render)
    {
        $this->operators[] = $render . ' Tr';
        return $this;
    }

    public function setRise(int $rise)
    {
        $this->operators[] = $rise . ' Ts';
        return $this;
    }

    public function nextLine($tx, $ty)
    {
        $this->operators[] = $tx . ' ' . $ty . ' Td';
        return $this;
    }

    public function nextLineSetLeading($tx, $ty)
    {
        $this->operators[] = $tx . ' ' . $ty . ' TD';
        return $this;
    }

    /**
     * @param Matrix $matrix
     * @return $this
     */
    public function setTextMatrix(Matrix $matrix)
    {
        $this->operators[] = $matrix . ' Tm';
        return $this;
    }

    public function nextLineStart()
    {
        $this->operators[] = 'T*';
        return $this;
    }

    /**
     * @param StringObject $text
     * @return $this
     */
    public function showText(StringObject $text)
    {
        $this->operators[] = $text . ' Tj';
        return $this;
    }

    /**
     * @param StringObject $text
     * @return $this
     */
    public function showTextOnNextLine(StringObject $text)
    {
        $this->operators[] = $text . " '";
        return $this;
    }

    /**
     * @param float $aw Word spacing
     * @param float $ac Character spacing
     * @param StringObject $text
     * @return $this
     */
    public function showTextOnNextLineWithSpacings($aw, $ac, StringObject $text)
    {
        $this->operators[] = "$aw $ac $text \"";
        return $this;
    }

    /**
     * @param ArrayObject $texts
     * @return $this
     */
    public function showTexts(ArrayObject $texts)
    {
        $this->operators[] = $texts . ' TJ';
        return $this;
    }



    protected function getOperators()
    {
        if (empty($this->operators)) {
            return '';
        }

        return implode("\n", $this->operators);
    }



}
