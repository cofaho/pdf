<?php

namespace pdf\Graphic\Operator;


use pdf\DataStructure\Matrix;
use pdf\Document\Page\PageDescriptionInterface;

interface SpecialGraphicsStateInterface
{
    public function saveState(): PageDescriptionInterface;

    public function restoreState(): PageDescriptionInterface;

    public function concatCurrentTransformationMatrix(Matrix $matrix): PageDescriptionInterface;
}
