<?php

namespace pdf\Graphic\Operator;


use pdf\DataStructure\Matrix;
use pdf\Document\Page\PageContentsInterface;

interface SpecialGraphicsStateInterface
{
    public function saveState(): PageContentsInterface;

    public function restoreState(): PageContentsInterface;

    public function concatCurrentTransformationMatrix(Matrix $matrix): PageContentsInterface;
}
